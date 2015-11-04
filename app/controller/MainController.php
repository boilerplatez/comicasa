<?php

namespace app\controller {

    use \RedBeanPHP\R;

    class MainController extends AbstractController
    {
        /**
         * @RequestMapping(url="home",method="GET",type="template")
         * @RequestParams(true)
         */
        function home($q, $p, $f, $action = "Login")
        {
            return RudraX::invokeHandler($action);
        }

        /**
         * @RequestMapping(url="album/{aid}",method="GET",type="template")
         * @RequestParams(true)
         */
        function viewAlbum($q, $p, $f, $aid)
        {
            return RudraX::invokeHandler("ViewAlbum");
        }

        /**
         * @RequestMapping(url="viewpic/{pid}",method="GET",type="template")
         * @RequestParams(true)
         */
        function viewPic($q, $p, $f, $pid)
        {
            return RudraX::invokeHandler("ViewPic");
        }

        /**
         * @RequestMapping(url="static/pri/{uid}/{v}",method="GET",type="template")
         * @RequestParams(true)
         */

        function viewFull($q, $p, $f, $d, $uid, $v)
        {
            //echo "nooo".$v;
            return RudraX::invokeHandler('Pic');
        }

        /**
         * @RequestMapping(url="uploader",method="GET",type="template")
         * @RequestParams(true)
         */
        function uploader($q, $p, $f, $d)
        {
            return RudraX::invokeHandler('Uploader');
        }

        /**
         * @RequestMapping(url="delete/{pid}",method="GET",type="template")
         * @RequestParams(true)
         */
        function delete($q, $p, $f, $pid)
        {
            return RudraX::invokeHandler('DeleteImage');
        }

        /**
         * @RequestMapping(url="upload",method="GET",type="template")
         * @RequestParams(true)
         */
        function upload($q, $p, $f, $d)
        {
            return RudraX::invokeHandler('Upload');
        }

        /**
         * @RequestMapping(url="admin/access",method="GET",type="template")
         * @RequestParams(true)
         */
        function imageAccess($q, $p, $f, $pid)
        {
            return RudraX::invokeHandler('ImageAccess');
        }

        /**
         * @RequestMapping(url="image/{pid}",method="GET",type="template")
         * @RequestParams(true)
         */
        function image($q, $p, $f, $pid)
        {
            return RudraX::invokeHandler("Image");
        }

        /**
         * @RequestMapping(url="",method="GET",type="template")
         * @RequestParams(true)
         */
        function comicsList($model)
        {
            Service::DBSetup();
            $comics = R::find("comic");

            $model->assign("comics",$comics);

            return "guest/comics";
        }

        /**
         * @RequestMapping(url="series/{comic_id}/vol/{vol}",type="template")
         * @RequestParams(true)
         */
        function comicDetails($model,$comic_id=0,$vol = 1)
        {
            Service::DBSetup();

            $comic = R::load("comic",$comic_id);
            $chapters = R::find("chapter", "comic_id = :comic_id AND vol = :vol",
                array("comic_id" => $comic_id,"vol"=>$vol));

            $model->assign("comic", $comic);
            $model->assign("volume", $vol);
            $model->assign("chapters", $chapters);

            return "guest/comic";
        }

        /**
         * @RequestMapping(url="series/{comic_id}/{vol}/ch/{inorder}", method="GET", type="template")
         * @RequestParams(true)
         */
        function readChapter($model,$comic_id = "0",$vol=1,$inorder = 1)
        {
            //echo("hey you".$comic_id." ".$chapter_id." ".$index);
            Service::DBSetup();
            $comic = R::load("comic",$comic_id);

            $chapter = R::findOne('chapter',' comic_id = :comic_id ORDER BY inorder asc,time asc LIMIT :inorder, 1',
                array( ":comic_id" => ($comic->id), ":inorder" => $inorder-1));
            $chapter->inorder = $inorder;

            $pages = R::find("page", "chapter_id = :chapter_id ORDER BY inorder",
                array(":chapter_id" => $chapter->id));
//            $page = R::getRow("SELECT page.*, chapter.* FROM page JOIN chapter
//            WHERE chapter.id = page.chapter_id AND chapter_id = :chapter_id
//            ORDER BY page_order, time asc LIMIT :page, 1",["chapter_id" => $chapter_id, "page" => $index]);

            $model->assign("comic", $comic);
            $model->assign("chapter", $chapter);
            $model->assign("pages", $pages);
            //print_r($page);

            //$model->assign("comics",$comics);

            return "guest/chapter";
        }

        /**
         * @RequestMapping(url="series/{comic_id}/{vol}/ch/{inorder}/page/{index}", method="GET", type="template")
         * @RequestParams(true)
         */
        function viewpage($model,$comic_id=0,$vol=1,$inorder=1,$index=1)
        {
            Service::DBSetup();
            //$inorder--;
            //$index--;

            $page_order = "asc";
            if($index == -1 || $index == "-1"){
                $inorder--;
                $page_order = "desc";
                $index = 1;
            } else if($index == 0 || $index == "0"){
                $index++;
            }

            if($inorder == -1 || $inorder == "-1" && $inorder == 0 || $inorder == "0"){
                return $this->comicDetails($model,$comic_id,$vol);
            }

            //print_line("== ".$inorder." ===".$index);

            $comic = R::load("comic",$comic_id);
            $chapter = R::findOne("chapter","comic_id = :comic_id ORDER BY inorder asc ,time asc LIMIT :inorder, 1",
                array( ":comic_id" => $comic->id, ":inorder" => $inorder-1));

            if($chapter == null){
                return $this->comicDetails($model,$comic_id,$vol);
            }
            $chapter->inorder = $inorder;

            $page = R::findOne("page", "chapter_id = :chapter_id ORDER BY inorder ".$page_order.", time ".$page_order." LIMIT :page, 1",
                array("chapter_id" => $chapter->id, "page" => $index-1));

            if($page==null){
                return $this->viewpage($model,$comic_id,$vol,$inorder+1,1);
            }
            //$page =$pages->;
            $page->index = $index;
            $page->isMyPic = $page->uid == $this->user->uid;

            $model->assign("comic", $comic);
            $model->assign("chapter", $chapter);
            $model->assign("page", $page);

            //$model->assign("comics",$comics);

            return "guest/page";
        }

    }
}


?>
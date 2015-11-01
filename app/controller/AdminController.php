<?php

namespace app\controller {

    use app\model\ImageUploader;
    use \RedBeanPHP\R;

    class AdminController extends AbstractController
    {
        /**
         * @RequestMapping(url="account",method="GET",type="template",auth=true)
         * @RequestParams(true)
         * @Role(USER)
         * @Role(ADMIN)
         */
        function myComics($model)
        {
            Service::DBSetup();
            $comics = R::find("comic", "uid = :uid", array("uid" => $this->user->uid));
            $model->assign("comics", $comics);
            $model->assign("user", $this->user);
            return "member/comics";
        }

        /**
         * @RequestMapping(url="account",method="POST",type="template",auth=true)
         * @RequestParams(true)
         * @Role(USER)
         * @Role(ADMIN)
         */
        function addComic($model,$action = null,$title=null)
        {
            Service::DBSetup();

            if($action== "add_comic" && $title!==null){
                $comic = R::dispense("comic");
                $comic->title = $title;
                $comic->uid = $this->user->uid;
                R::store($comic);
            }
            return $this->myComics($model);
        }


        /**
         * @RequestMapping(url="account/comic/{comic_id}/{vol}",type="template",auth=true)
         * @RequestParams(true)
         * @Role(USER)
         * @Role(ADMIN)
         */
        function comicDetails($model,$comic_id=null,$action = null,$title=null,$vol=1)
        {
            Service::DBSetup();

            $comic = R::load("comic",$comic_id);

            if($action == "add_chapter" && $title!==null){
                $chapter = R::dispense("chapter");
                $chapter->title = $title;
                $chapter->uid = $this->user->uid;
                $chapter->vol = $vol;
                $chapter->comic = $comic;
                $chapter->inorder = R::count("chapter", "comic_id = :comic_id AND vol = :vol", array("comic_id" => $comic_id,"vol"=>$vol));
                $chapter->time = microtime(true);
                R::store($chapter);
            }

            $chapters = R::find("chapter", "comic_id = :comic_id AND vol = :vol", array("comic_id" => $comic_id,"vol"=>$vol));
            //print_r($comic);
            $model->assign("comic", $comic);


            $model->assign("chapters", $chapters);
            $model->assign("user", $this->user);

            return "member/comic";
        }


        /**
         * @RequestMapping(url="account/chapter/{chapter_id}",type="template",auth=true)
         * @RequestParams(true)
         * @Role(USER)
         * @Role(ADMIN)
         */
        function editChapter($model,$chapter_id=null,$action = null,$title=null)
        {
            Service::DBSetup();

            $chapter = R::load("chapter",$chapter_id);
            $comic = R::load("comic",$chapter->comic_id);

            $pages = R::find("page", "chapter_id = :chapter_id ORDER BY inorder, time asc", array(":chapter_id" => $chapter_id));
            $model->assign("pages", $pages);
            $model->assign("chapter", $chapter);
            $model->assign("comic", $comic);
            return "member/chapter";
        }

        /**
         * @RequestMapping(url="account/chapter/{chapter_id}/upload",type=json,auth=true)
         * @RequestParams(true)
         * @Role(USER)
         * @Role(ADMIN)
         */
        function uploadPage($model,$chapter_id=null,$action = null,$title=null)
        {
            Service::DBSetup();

            $uploader =  new ImageUploader(array(
                'user_token' => $this->user->uid
            ));

            if($uploader->file != null){
                $page = R::dispense("page");
                $page->chapter_id = $chapter_id;
                $page->uid = $this->user->uid;
                $page->name = $uploader->file->name;
                $page->size = $uploader->file->size;
                $page->type = $uploader->file->type;
                $page->title = $uploader->file->title;
                $page->description = $uploader->file->description;
                $page->time = microtime(true);
                $page->inorder = 0;
                $page->file_path = $uploader->file->path;
                $page->thumbnail = $uploader->file->thumbnail;
                $uploader->file->id = R::store($page);
            }
            return $uploader->content;
        }

        /**
         * @RequestMapping(url="account/chapter/{chapter_id}/page/{page_id}",type=template,auth=true)
         * @RequestParams(true)
         * @Role(USER)
         * @Role(ADMIN)
         */
        function editPage($model,$chapter_id=null,$page_id = null,$title=null)
        {
            Service::DBSetup();
            $page = R::load("page",$page_id);
            $chapter = R::load("chapter",$page->chapter_id);
            $comic = R::load("comic",$chapter->comic_id);


            $model->assign("comic", $comic);
            $model->assign("chapter", $chapter);
            $model->assign("page", $page);
            return "member/page";
        }

    }
}


?>
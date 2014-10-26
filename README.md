Installation Guide
==================
To get the best you need to install these on your machine

1) GIT or GIT bash for windows (Version Control)
	- http://git-scm.com/downloads
	
2) Composer (Dependency Manager)
	- https://getcomposer.org/download/
	
3) Spring Tool Suite 3.5.1 (IDE)
	- http://spring.io/tools/sts/all
	
4) Eclipse PDT (PHP plugin for Spring)
	a) Start STS.
	b) Under the help menu, click on install new software.
	c) Click Add.
	d) Input any name, then http://download.eclipse.org/releases/juno/ in the location field, then press ok.
	e) Select the newly added update site from the drop down list, then select Eclipse PDT and install.
	f) After STS restarts, installing smartypdt will work now.

5) SmartyPDT 0.9.1 (Editor plugin for TPL files in Spring)
	Be sure that the .TPL files are not associated with any content type (file type). 
	
	In STS, go to Window->Preferences->General->Content Types and under the Text section check HTML and PHP Content Type If you see that the .TPL is associated with anything, just delete those entries.
	
	a) Go to Help-> Install New Software
	At the Work With section click on the Add... button. Give the new "Site" a name and set the location with http://smartypdt.googlecode.com/svn/trunk/org.eclipse.php.smarty.updatesite/ ,then click OK. Go back to the Install New Software window and select the newly added "site". If the "Group items by category" check-box is checked, uncheck it. Now you should be able to see 1 item in the software list named "Smarty Feature"
	
	b) Select the Smarty Feature, click Next> and from here afterwards it shouldn't be a problem.
	If you are prompted that this is an unsigned package, just ignore the warning and install it anyway.
	
	c)After the installation completes, restart Eclipse and it should be working.
	d) Define a default PHP executable of type 'Zend Debugger' (only if you install vanilla Eclipse PDT):
	In STS go to Window->Preferences->PHP->PHP Executables Click on the Add button. Enter a name for that executable definition, for example "PHP localhost", complete the 2 fields which ask you for the PHP executable path (the PHP binary CLI executable) and php.ini path. Be sure that the PHP debugger is the Zend Debugger.


Project Setup
=============

1) Go to your 'projects' folder
	
	a) Right Click and Select Git Bash
		- or you can start git bash and go to 'projects' folder using cd command
	
	b) Tell Git Who you Are
		$ git config --global user.name = "Your Name"
		$ git config --global user.email = "you@somemail.com"
		
	c) Enter Clone Command
		$ git clone _my_git_repo_path_url_for_project_  myProjectName
	
	d) Now you have one folder named 'myProjectName' inside proejtcs automatically created, 
		enter this folder using cd command
		$ cd myProjectName
		
	e) Set this so that git will remember you
		$ git config credential.helper 'store'
		
	f) Regular Commands you will need to remember (no need to use them now)
		
		A) To Pull Latest Code
			$ git stash
			$ git pull --rebase
			$ git stash pop
		
		B) To Push Changes to main directory
			$ git gui
				add files one by one by clicking on file icons.
				enter commit message and press 'Commit'
				click 'Push'
				
		if you see failure then Pull latest Code (as in Step A) and then try Push again (Step B)
	
	g) In console type 
		$ composer install
		
2) Import Project in STS
	
	a) File-> New -> Project -> PHP Project
	
	b) Enter Project Name
	
	c) Create Project at Existing Location and Browse to your project location

3) Configure Appache to point to the folder projects/myProjectName
	in you browser type
	http://localhost/web/
	
	
Project Folder Struture
=============
PROJECT
	->app
		->handler
		->model
		->view
	->lib
	->build
	->web
	->resources
	
Note :- 'build' folder needs appropriate write persmissions
		

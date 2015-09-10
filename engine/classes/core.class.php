<?php ob_start();
		abstract class Core {
		public $_tamplate = "defaultTmp";

		public function __construct(){
			session_start();
			

		}
		
		private function replaceStringContent($tmp_content) {
			return str_replace("%content%",$this->getContent(),$tmp_content);
		}
		
		private function replaceString($tmp_content) {	
			$tmp_name = $this->_tamplate;
			preg_match_all("/%(.*)%/", $tmp_content, $array_result);
			for($i =0;$i < count($array_result[0]); $i++) {
				$path_include = ROOT."/engine/templates/".$tmp_name."/".$array_result[1][$i].".php";
				if(file_exists($path_include)) {
					$text_file = file_get_contents($path_include);
					$tmp_content = str_replace($array_result[0][$i], $text_file, $tmp_content);
				}
			}
			
			return $tmp_content;
			
		}
		
		private function replaceStringTitle($tmp_content) {
			return str_replace("%title%",$this->getTitle(),$tmp_content);
		}
		
		private function replaceStringRoot($tmp_content) {
			$tmp_name = $this->_tamplate;
			$root = 'engine/templates/'.$tmp_name;
			return str_replace("%root%",$root,$tmp_content);
		}

			public function getBody(){
				$tmp_name = $this->_tamplate;
				$tmp_url = ROOT."/engine/templates/".$tmp_name."/main.php";

				if(file_exists($tmp_url)){
					$tmp = file_get_contents($tmp_url);
					$tmp = $this->replaceString($tmp);
					$tmp = $this->replaceStringRoot($tmp);
					$tmp = $this->replaceStringTitle($tmp);
					$tmp = $this->replaceStringContent($tmp);
					ob_end_clean();	
					$save = $this->unicName();


					file_put_contents($save, $tmp);
					require_once($save);	

					unlink($save);
					
				}
				else{
					echo "bliyaaaaaaaaaaaaaaaaa";
					
				}
				
				
			}

			public function sift($string){
				$list = array(
					"<?" => "&lt;?",
					"?>" =>"?&gt;"
					);
				foreach ($list as $key => $value) {
					$string = str_replace($key , $value , $string);

				}
				return $string;
			}

			public function getView(){
				$args = func_get_args();
				$tmp = $this->_tamplate;
				$view = ROOT."/engine/templates/".$tmp."/view.php";				

				$list = array();

				for($i = 0 ; $i < count($args) ; $i++){
					if(!($i%2)){
						$list[$args[$i]] = $this->sift($args[$i + 1]);
					}
				}

				if(file_exists($view)){
					$view_tmp  = file_get_contents($view);
					foreach($list as $k => $v){
						$view_tmp = str_replace("%".$k."%", $v, $view_tmp);

					}

					return $view_tmp;

				}else{
					throw new Exception("non shablona");
				}
				
			}
			public function getView_product(){
				$args = func_get_args();
				$tmp = $this->_tamplate;
				$view = ROOT."/engine/templates/".$tmp."/view_product.php";				

				$list = array();

				for($i = 0 ; $i < count($args) ; $i++){
					if(!($i%2)){
						$list[$args[$i]] = $this->sift($args[$i + 1]);
					}
				}

				if(file_exists($view)){
					$view_tmp  = file_get_contents($view);
					foreach($list as $k => $v){
						$view_tmp = str_replace("%".$k."%", $v, $view_tmp);

					}

					return $view_tmp;

				}else{
					throw new Exception("non shablona");
				}
				
			}
			public function pageNav($nPage , $quantity){
				// пагинатор < | back | 1 |2 | {3} | 4 | 5 | forward | >
				$aad_class ="<div id = 'navigation-page'>";
				 $end_add_class = "</div>";
				$limit = QUANTINY_NEWS;
				$pages = ceil($quantity/$limit);
				$first = "";
				$back = "";
				$page1left = "";
				$page2left = "";
				$page = '<span class = "light-page-nav">'.$nPage.'</span>';
				$page1right = "";
				$page2right = "";
				$forward="";
				$last = "";
				$uri = "?";
				foreach ($_GET  as $key => $value) {
					if($key != "page"){
						$uri .= $key."=".$value."&";
					}
				}

				if($nPage > 3){
					$first = '<a href = "'.$uri.'page=1" class = "dark-page-nav">&laquo;</a>';
				}
				if($nPage > 1){
					$back = '<a href = "'.$uri.'page='.($nPage - 1).'" class = "dark-page-nav">&lt;</a>';
				}

				if(($nPage - 2) >  0){
				$page2left = '<a href = "'.$uri.'page='.($nPage - 2).'" class = "dark-page-nav">'.($nPage - 2).'</a>';
				}
				if(($nPage - 1) >  0){
				$page1left = '<a href = "'.$uri.'page='.($nPage - 1).'" class = "dark-page-nav">'.($nPage - 1).'</a>';
				}
				if($nPage < $pages){
					$page1right = '<a href = "'.$uri.'page='.($nPage + 1).'" class = "dark-page-nav">'.($nPage + 1).'</a>';
				}
				if(($nPage + 1) < $pages){
					$page2right = '<a href = "'.$uri.'page='.($nPage + 2).'" class = "dark-page-nav">'.($nPage + 2).'</a>';
				}
				if($nPage < $pages ){
					$forward = '<a href = "'.$uri.'page='.($nPage + 1).'" class = "dark-page-nav">&gt;</a>';
				}
				if($nPage < ($pages - 2)){
					$last = '<a href = "'.$uri.'page='.$pages.'" class = "dark-page-nav">&raquo;</a>';
				}


				return $aad_class.$first.$back.$page2left.$page1left.$page.$page1right.$page2right.$forward.$last.$end_add_class;


			}

			public function toInteger($int){
				$int = abs((int)$int);
				return $int;
			}
			function unicName(){
				$unicName = md5(uniqid());
				$path = "server/".$unicName.".php";
				if(!file_exists($path)){

						return $path;
				}else
				{
					$this->unicName($path);
				}

			}

			abstract function getTitle();

			abstract function getContent();
		function clearString($string){
			return trim(htmlspecialchars(stripcslashes($string)));
		}

		}


?>


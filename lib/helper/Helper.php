<?php

function randomString($n) {

	$generated_string = "";

	$domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

	$len = strlen($domain);

	// Loop to create random string
	for ($i = 0; $i < $n; $i++) {
		// Generate a random index to pick characters
		$index = rand(0, $len - 1);

		// Concatenating the character
		// in resultant string
		$generated_string = $generated_string . $domain[$index];
	}

	return $generated_string;
}

function clean_input(string $text):string{
    $txt = trim($text);
    $txt = htmlspecialchars($txt);
    $txt = stripslashes($text);

    return $txt;
}

function clearAuthCookie() {

	unset($_COOKIE['series_id']);
	unset($_COOKIE['remember_token']);
	setcookie('series_id', null, -1, '/');
	setcookie('remember_token', null, -1, '/');
}

function messages(){
    return "hellow";
}


// <li class="page-item"><a class="page-link" href="#">1</a></li>
// <li class="page-item"><a class="page-link" href="#">2</a></li>
// <li class="page-item"><a class="page-link" href="#">3</a></li>
// 


function paginateController(string $page,int $total,int $current){

	$pageButton = "";
	if($total<=5){
		for($i=1;$i<=$total;$i++){
			$pageButton .= "<li class= 'page-item'><a class='page-link' href=".$page."?page=".$i.">$i</a></li>";
		};

	}else{
		
		if($current<=3){
			for($i=1;$i<=5;$i++){
				$pageButton .= "<li class= 'page-item'><a class='page-link' href=".$page."?page=".$i.">$i</a></li>";
			}
		}else if($current  >= ($total-2)){

			
			$after =( $total - $current)+1;

			$before = 5-$after;
			for($i=$current-1;$i>=($current - $before);$i--){
				$pageButton = "<li class= 'page-item'><a class='page-link' href=".$page."?page=".$i.">$i</a></li>".$pageButton;
			}

			for($i=$current;$i<=$total;$i++){
				$pageButton .= "<li class= 'page-item'><a class='page-link' href=".$page."?page=".$i.">$i</a></li>";
			}

		}else{
			$pageButton .= "<li class= 'page-item'><a class='page-link' href=".$page."?page=".($current-2).">".($current-2)."</a></li>";
			$pageButton .= "<li class= 'page-item'><a class='page-link' href=".$page."?page=".($current-1).">".($current-1)."</a></li>";
			for($i=$current;$i<=($current+2);$i++){
				$pageButton .= "<li class= 'page-item'><a class='page-link' href=".$page."?page=".$i.">$i</a></li>";
			}

		}
	}
	$prev = 1;
	if($current != 1){
		$prev = $current -1;
	}

	$next = $total;
	if($current != $total){
		$next = $current +1;
	}

	$pageButton = "<li class='page-item'><a class='page-link' href='/admin/students.php?page=".$prev."'>«</a></li>".$pageButton;
	$pageButton .= "<li class='pag-item'><a class='page-link' href='/admin/students.php?page=".$next."'>»</a></li>";
	return $pageButton;
}

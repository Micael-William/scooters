<?php
if ($pg_int <> "S"){
	$redir="Location:index_adm.php";
	header($redir);
}else{
	echo "<div class='card'>";
	echo "<br><br><br><br><br><br><br><br>";
	echo "</div>";//<!-- card-body -->"

    echo "<div class='card-footer'>";
    echo "";
    echo "</div>";//<!-- card-footer -->"
    
	echo "</div>";//<!-- card -->

}//pg_int
?>
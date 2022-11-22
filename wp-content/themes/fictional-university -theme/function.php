<?php
if(isset($_POST['submitbtn'])){
$data=array(
'title'=>$_POST['title'],
'author'=>$_POST['author'],
);
$table_name='books';
$result=$wpdb=>insert($table_name,$data,$format=NULL);
if($result==1){
echo "<script> alert('Book Saved')</script>";
}
else {
echo "<script> alert('Unable Saved')</script>";
}
}

?>
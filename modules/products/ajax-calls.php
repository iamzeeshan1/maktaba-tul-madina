<?php
include("../../includes/header-min.php");
// $emp_id = $_SESSION['emp_id'];

if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'add_new_misc_prod'){
    $name = validate_string($link,$_POST['name']);
    $qry_uniq=fetch_data($link,"SELECT misc_prod_name from invt_misc where misc_prod_name='$name'");
    if(count($qry_uniq) > 0){
        echo "misc_error";
        exit();
    }
    else{
        $qry = add_data($link,"invt_misc",['misc_prod_name'=>$name],false);
    }
    //ajax response
    $dropdown_class ="";
    $dropdown_class .="<label for='misc_id' class='mg-b-10 form-label'>Miscellaneous Products</label>";
    $dropdown_class .= "<select name='misc_id' class='form-select select2' id='misc_id' onchange='fn_misc(this.value)'";
    $dropdown_class .= "<option  selected>Select- </option>";
    $sql =fetch_data($link,"Select * from invt_misc");
    foreach($sql as $row_q)
    {
        $selected = ($name == $row_q['misc_prod_name']) ? "selected" : "";

       $id= $row_q['misc_id'];
       $misc_prod_name = $row_q['misc_prod_name'];
       $dropdown_class .= "<option value='".$id."' ".$selected.">".$misc_prod_name."</option>";
     }
    $dropdown_class .="<option value='other'>Other</option>";
    $dropdown_class .="</select>";
    echo $dropdown_class;
}
?>
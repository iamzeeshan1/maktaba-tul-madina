<?php
include("../../includes/header-min.php");
$emp_id = $_SESSION['emp_id'];
if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'add_new_rack'){
    $name = validate_string($link,$_POST['name']);
    $qry_uniq=fetch_data($link,"SELECT rack_name from invt_racks where rack_name='$name'");
    if(count($qry_uniq) > 0){
        echo "rack_error";
        exit();
    }
    else{
        $qry = add_data($link,"invt_racks",['rack_name'=>$name],false);
    }
    //ajax response
    $dropdown_class ="";
    $dropdown_class .= "<option  selected>Select- </option>";
    $sql =fetch_data($link,"Select * from invt_racks");
    foreach($sql as $row_q)
    {
        $selected = ($name == $row_q['rack_name']) ? "selected" : "";

       $id= $row_q['rack_id'];
       $rack_name = $row_q['rack_name'];
       $dropdown_class .= "<option value='".$id."' ".$selected.">".$rack_name."</option>";
     }
    $dropdown_class .="<option value='other'>Other</option>";
    echo $dropdown_class;
}
else if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'add_new_section'){
    $name = validate_string($link,$_POST['name']);
    $qry_uniq=fetch_data($link,"SELECT section_name from invt_sections where section_name='$name'");
    if(count($qry_uniq) > 0){
        echo "section_error";
        exit();
    }
    else{
        $qry = add_data($link,"invt_sections",['section_name'=>$name],false);
    }
    //ajax response
    $dropdown_class ="";
    $dropdown_class .= "<option  selected>Select- </option>";
    $sql =fetch_data($link,"Select * from invt_sections");
    foreach($sql as $row_q)
    {
        $selected = ($name == $row_q['section_name']) ? "selected" : "";

       $id= $row_q['section_id'];
       $section_name = $row_q['section_name'];
       $dropdown_class .= "<option value='".$id."' ".$selected.">".$section_name."</option>";
     }
    $dropdown_class .="<option value='other'>Other</option>";
    echo $dropdown_class;
}
else if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'add_new_location'){
    $name = validate_string($link,$_POST['name']);
    $qry_uniq=fetch_data($link,"SELECT location_name from invt_locations where location_name='$name'");
    if(count($qry_uniq) > 0){
        echo "location_error";
        exit();
    }
    else{
        $qry = add_data($link,"invt_locations",['location_name'=>$name],false);
    }
    //ajax response
    $dropdown_class ="";
    $dropdown_class .= "<option  selected>Select- </option>";
    $sql =fetch_data($link,"Select * from invt_locations");
    foreach($sql as $row_q)
    {
        $selected = ($name == $row_q['location_name']) ? "selected" : "";

       $id= $row_q['location_id'];
       $location_name = $row_q['location_name'];
       $dropdown_class .= "<option value='".$id."' ".$selected.">".$location_name."</option>";
     }
    $dropdown_class .="<option value='other'>Other</option>";
    echo $dropdown_class;
}
else if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'add_new_category'){
    $name = validate_string($link,$_POST['name']);
    $qry_uniq=fetch_data($link,"SELECT category_name from invt_categorys where category_name='$name'");
    if(count($qry_uniq) > 0){
        echo "category_error";
        exit();
    }
    else{
        $qry = add_data($link,"invt_categorys",['category_name'=>$name],false);
    }
    //ajax response
    $dropdown_class ="";
    $dropdown_class .= "<option  selected>Select- </option>";
    $sql =fetch_data($link,"Select * from invt_categorys");
    foreach($sql as $row_q)
    {
        $selected = ($name == $row_q['category_name']) ? "selected" : "";

       $id= $row_q['category_id'];
       $category_name = $row_q['category_name'];
       $dropdown_class .= "<option value='".$id."' ".$selected.">".$category_name."</option>";
     }
    $dropdown_class .="<option value='other'>Other</option>";
    echo $dropdown_class;
}
?>
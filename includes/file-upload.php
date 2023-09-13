<?php
function upload_file($_control_name, $_upload_file_name, $_path_to_save, $attachment_field, $criteria_field, $criteria_value, $table, $link, $file_tmp_name = "", $file_size = "", $file_type = "")
{

	if ($_control_name != NULL && $_control_name != "") {
		$_tmp_name	=	$_control_name['tmp_name'];
		$_size		=	$_control_name['size'];
		$_type		=	basename($_control_name['type']);
	} else {
		$_tmp_name	=	$file_tmp_name;
		$_size		=	$file_size;
		$_type		=	$file_type;
	}
	if ($_type == "vnd.openxmlformats-officedocument.wordprocessingml.document") {
		$_type = "docx";
	} else if ($_type == "vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
		$_type = "xlsx";
	} else if ($_type == "vnd.openxmlformats-officedocument.presentationml.presentation") {
		$_type = "pptx";
	} else if ($_type == "msword") {
		$_type = "doc";
	}


	//----------------------Validate file extention------------------------
	if ($_type != "jpeg" and $_type != "jpg" and $_type != "png" and $_type != "doc" and $_type != "msword" and $_type != "pdf" and $_type != "docx" and $_type != "rtf" and $_type != "txt" and $_type != "webp" and $_type != "xls" and $_type != "xlsx" and $_type != "ppt" and $_type != "pptx") {
		return "err=format";
	}
	//----------------------Validate File Size------------------------
	if ($_size > 8097152 or $_size == 0) // 8mb
	{
		return "err=size";
	}

	//----------------------------Start Uploading--------------------------------
	// Add the original filename to our target path. Result is "uploads/filename.extension"

	if (!is_dir($_path_to_save)) {
		mkdir($_path_to_save, 0755, true);
	}

	$target_path = $_path_to_save . $_upload_file_name;
	if (file_exists($target_path)) {
		unlink($target_path);
	}

	if (move_uploaded_file($_tmp_name, $target_path)) {
		$qry_upload = "UPDATE $table set $attachment_field='$_upload_file_name' WHERE $criteria_field='$criteria_value'";
		$chk = insert_update_delete_data($link, $qry_upload);
		if ($chk == 1) {
			return "err=ok";
		} else {
			delete_uploaded_file_row($criteria_field, $criteria_value, $table, $link);
			return "err=fail";
		}
	} else {
		delete_uploaded_file_row($criteria_field, $criteria_value, $table, $link);
		return "err=fail";
	}
}
function delete_uploaded_file_row($criteria_field, $criteria_value, $table, $link)
{
	//delete the record as doc not uploaded
	$qry_del = "DELETE FROM $table WHERE $criteria_field = '$criteria_value'";
	$chk_att = insert_update_delete_data($qry_del, $link);
}


function upload_multiple_files($files, $_path_to_save, $attachment_field, $criteria_field, $criteria_value, $table, $link)
{
	$results = [];

	if (!is_dir($_path_to_save)) {
		mkdir($_path_to_save, 0755, true);
	}

	foreach ($files as $file_info) {
		$_tmp_name = $file_info['tmp_name'];
		$_size = $file_info['size'];
		$_type = basename($file_info['type']);
		$_upload_file_name = $file_info['upload_file_name'];

		if ($_type == "vnd.openxmlformats-officedocument.wordprocessingml.document") {
			$_type = "docx";
		} else if ($_type == "vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
			$_type = "xlsx";
		} else if ($_type == "vnd.openxmlformats-officedocument.presentationml.presentation") {
			$_type = "pptx";
		} else if ($_type == "msword") {
			$_type = "doc";
		}

		//----------------------Validate file extension------------------------
		if ($_type != "jpeg" and $_type != "jpg" and $_type != "png" and $_type != "doc" and $_type != "msword" and $_type != "pdf" and $_type != "docx" and $_type != "rtf" and $_type != "txt" and $_type != "webp" and $_type != "xls" and $_type != "xlsx" and $_type != "ppt" and $_type != "pptx") {
			$results[] = "err=format";
			continue;
		}

		//----------------------Validate File Size------------------------
		if ($_size > 8097152 || $_size == 0) // 8mb
		{
			$results[] = "err=size";
			continue;
		}

		$file_name = $_upload_file_name;
		$target_path = $_path_to_save . $file_name;

		if (file_exists($target_path)) {
			unlink($target_path);
		}

		if (move_uploaded_file($_tmp_name, $target_path)) {
			$qry_upload = "UPDATE $table SET $attachment_field='$file_name' WHERE $criteria_field='$criteria_value'";
			$chk = insert_update_delete_data($link, $qry_upload);
			if ($chk == 1) {
				$results[] = "err=ok";
			} else {
				delete_uploaded_file_row($criteria_field, $criteria_value, $table, $link);
				$results[] = "err=fail";
			}
		} else {
			delete_uploaded_file_row($criteria_field, $criteria_value, $table, $link);
			$results[] = "err=fail";
		}
	}
	return $results;
}
?>
<?php
/**
 * Cms 公共方法文件
 */

/**
 * 文件上传到服务器操作方法
 * string $local_filename 要上传的文件名
 * string $file_ext_name 文件后缀名
 * string $meta_list 文件属性详细列表
 * string $group_name storage的组名
 * array $tracker_server  Fast的服务器地址
 * array $storage_server group地址
 * sring return 返回图片url
 */
function fdfs_upload($local_filename,$file_ext_name="jpg",$meta_list="",$group_name="",$tracker_server=array(),$storage_server=array()) {
        //$result = fastdfs_storage_upload_by_filename($local_filename,$file_ext_name,$meta_list,$group_name,$tracker_server,$storage_server);
        $result = fastdfs_storage_upload_by_filename($local_filename,$file_ext_name);
        if($result){
            $group = isset($result["group_name"]) && !empty($result["group_name"]) ? $result["group_name"] : "";
            $filename = isset($result["filename"]) && !empty($result["filename"]) ? $result["filename"] : "";
            if(empty($group) || empty($filename)){
                return array("data"=>"","res"=>-1,"dis"=>"上传失败");exit;
            }
            $link = $group."/".$filename;
            return array("data"=>$link,"res"=>1,"dis"=>"上传成功");exit;
        }
        return array("data"=>"","res"=>-1,"dis"=>"上传失败");exit;
}
?>

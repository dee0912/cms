<?php

namespace Cms\Controller;

use Think\Controller;

class CmsController extends Controller {
    
    /*
    private $success = "操作成功";
    private $error = "操作失败";
    //page列表
    public function indexPage() {
        $cms=M('ad_page', '', 'DB_CMS');
        $fields = "page_id,code_name,display_name,sortby,creation_time,modification_time";
        if(I("param.display_name")){
            $where["display_name"] = array("like",$_GET["display_name"]);
        }
        if(I("param.code_name")){
             $where["code_name"] = array("like",$_GET["code_name"]);
        }
        $where["is_enabled"] = I("param.is_enabled") ? I("param.is_enabled") : 1;
        $pagesize = I("param.pagesize") ?I("param.pagesize") : 3;
        $page = I("param.page") ? (I("param.page")-1) : 0;
        if(I("param.sortby")){
            $result["data"] = $cms->where($where)->field($fields)->order('sortby '.I("param.sortby"))->limit(($pagesize*$page).','.$pagesize)->select();
        }else{
            $result["data"] = $cms->where($where)->field($fields)->limit(($pagesize*$page).','.$pagesize)->select();
        }
        $result["count"] = $cms->where($where)->count();
        $result["page"] = $page;
        if($result["data"]){
            $result["result"] = 1;
            $result["dis"] = $this->success;
            echo json_encode($result);exit;
        }else{
            $result["result"] = -1;
            $result["dis"] = $this->error;
            echo json_encode($result);exit;
        }
    }
    //获取page详情
    public function indexPageDetail() {
        $result["data"] = array();
        if(I("param.page_id")){
            $cms=M('ad_page', '', 'DB_CMS');
            $where["page_id"] = $_GET["page_id"];
            $fields = "page_id,code_name,display_name,sortby";
            $data = $cms->where($where)->field($fields)->find();
            if($data){
                $result["data"] = $data;
                $result["result"] = 1;
                $result["dis"] = $this->success;
                echo json_encode($result);exit;
            }else{
                $result["result"] = -1;
                $result["dis"] = $this->error;
            }
        }else{
            $result["result"] = -1;
            $result["dis"] = "page_id不能为空";
        }
        echo json_encode($result);exit;
    }
    /**
     * @action 添加page页
     * type  GET|POST 传参方式
     * @param code_name  page页name值
     * @param display_name  管理系统中展示的名称
     * @param sortby  顺序
     */
    /*
    public function addPage() {
        $data = array();
        if(I("param.")){
            $data = I("param.");
            $cms=M('ad_page', '', 'DB_CMS');
            $now_date = date("Y-m-d H:m:i",time());
            $data["is_enabled"] = 1;
            $data["creation_time"] = $now_date;
            $data["modification_time"] = $now_date;
            $res = $cms->add($data);
            if($res){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "没有参数";
        }
        echo json_encode($return);
    }
    //编辑page页
    public function editPage() {
        $cms=M('ad_page', '', 'DB_CMS');
        if(I("param.")){
            $data = I("param.");
            $now_date = date("Y-m-d H:m:i",time());
            $data["is_enabled"] = 1;
            $data["creation_time"] = $now_date;
            $data["modification_time"] = $now_date;
            $res = $cms->save($data);
            if($res){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "没有参数";
        }         
        echo json_encode($return);exit; 
    }
    //删除page页
    public function delPage() {
        if(I("param.page_id") && I("param.page_id") > 0){
            $cms=M('ad_page', '', 'DB_CMS');
            $where["page_id"] = I("param.page_id");
            $where["is_enabled"] = -1;
            $result = $cms->save($where);
            if($result){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "page_id不能为空";
        }
        echo json_encode($return);exit;
    }
    //position列表
    public function indexPosition() {
        $cms=M('', '', 'DB_CMS');
        $fields = "a.page_id,a.code_name,a.display_name,a.creation_time,a.modification_time,a.description,a.type,b.display_name as page_name";
        $join_a =  "ad_page b on a.page_id=b.page_id";
        
        if(I("param.display_name")){
            $where["a.display_name"] = array("like",I("param.display_name"));
        }
        if(I("param.code_name")){
            $where["a.code_name"] = array("like",$_GET["code_name"]);
        }
        if(I("param.page_id")){
            $where["a.page_id"] = $_GET["page_id"];
        }
        $where["a.is_enabled"] = I("param.is_enabled") ? I("param.is_enabled") : 1;
        $pagesize = I("param.pagesize") ? I("param.pagesize") : 10;
        $page = I("param.page") ? (I("param.page")-1) : 0;
        if(I("param.sortby")){
            $data = $cms->table("ad_position as a")->join($join_a)->where($where)->field($fields)->order('a.sortby '.I("param.sortby"))->limit(($pagesize*$page).','.$pagesize)->select();
        }else{
            $data = $cms->table("ad_position as a")->join($join_a)->where($where)->field($fields)->limit(($pagesize*$page).','.$pagesize)->select();
        }
        $result["count"] = $cms->table("ad_position as a")->join($join_a)->where($where)->count();
        $result["page"] = $page;
        $result["data"] = array();
        if($data){
            $result["data"] = $data;
            $result["result"] = 1;
            $result["dis"] = "操作成功";
        }else{
            $result["result"] = -1;
            $result["dis"] = "操作失败";            
        }
        echo json_encode($result);exit;
    }
    //获取position 详情
    public function indexPositionDetail() {
        $result["data"] = array();
        if(I("param.position_id")){
            $cms=M('', '', 'DB_CMS');
            $fields = "code_name,display_name,description,type,sortby";
            $data = $cms->table("ad_position")->where($where)->field($fields)->select();
            if($data){
                $result["data"] = $data;
                $result["result"] = 1;
                $result["dis"] = "操作成功";
            }else{
                $result["result"] = -1;
                $result["dis"] = "操作失败";            
            }
        }else{
            $result["result"] = -1;
            $result["dis"] = "page_id不能为空";
        }
        echo json_encode($result);exit;
    }
    //添加postion
    public function addPosition() {
        if(I("param.")){
            $data = I("param.");
            $cms=M('ad_position', '', 'DB_CMS');
            $now_date = date("Y-m-d H:m:i",time());
            $data["is_enabled"] = 1;
            $data["creation_time"] = $now_date;
            $data["modification_time"] = $now_date;
            $res = $cms->add($data);
            if($res){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
            echo json_encode($return);
        }else{
              $return["result"] = -1;
              $return["dis"] = "没有传参";
        }
    }
    //编辑postion
    public function editPosition() {
        $cms=M('ad_position', '', 'DB_CMS');
        if(I("param.")){
            $data = I("param.");
            $now_date = date("Y-m-d H:m:i",time());
            $data["modification_time"] = $now_date;
            $res = $cms->save($data);
            if($res){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "参数不能为空";
        }
        echo json_encode($return);exit; 
    }
    //删除postion
    public function delPosition() {
        if(I("param.position_id") && I("param.position_id") > 0){
            $cms=M('ad_position', '', 'DB_CMS');
            $where["position_id"] = I("param.position_id");
            $where["is_enabled"] = -1;
            $result = $cms->save($where);
            if($result){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "page_id不能为空";
        }
        echo json_encode($return);exit;
    }
    //推广content列表
    public function indexContent() {
        $cms=M('', '', 'DB_CMS');
        $fields = "a.content_id,a.name,a.pic_url,a.text,a.link,a.obj_url,a.product_id,a.start_time,a.end_time,a.sortby,a.creation_time,a.modification_time,b.display_name as position_name";
        $join_a =  "left join ad_position b on a.content_id=b.position_id";
        $join_b =  "left join ad_page c on b.page_id=b.page_id";
        if(I("param.name")){
            $where["a.name"] = array("like",I("param.name"));
        }
        if(I("param.start_time")){
            $where["a.start_time"] = array("egt",I("param.start_time"));
        }
        if(I("param.end_time")){
            $where["a.end_time"] = array("elt",I("param.end_time"));
        }
        if(I("param.position_id")){
            $where["a.position_id"] = array("like",I("param.position_id"));
        }
        $where["a.is_enabled"] = I("param.is_enabled") ? I("param.is_enabled") : 1;
        $pagesize = I("param.pagesize") ? I("param.pagesize") : 10;
        $page = I("param.page") ? (I("param.page")-1)  : 0;
        if(I("param.sortby")){
           $data = $cms->table("ad_content as a")->join($join_a)->where($where)->field($fields)->order('a.sortby '.I("param.sortby"))->limit(($pagesize*$page).','.$pagesize)->select(); 
        }else{
           $data = $cms->table("ad_content as a")->join($join_a)->where($where)->field($fields)->limit(($pagesize*$page).','.$pagesize)->select(); 
        }
        $result["count"] = $cms->table("ad_content as a")->join($join_a)->where($where)->count();
        $result["page"] = $page;
        $result["data"] = array();
        if($data){
            $result["data"] = $data;
            $result["result"] = 1;
            $result["dis"] = "操作成功";
        }else{
            $result["result"] = -1;
            $result["dis"] = "操作失败";
        }
        echo json_encode($result);exit;
    }
    //获取position 详情
    public function indexContentDetail() {
        $result["data"] = array();
        if(I("param.content_id")){
            $cms=M('ad_content', '', 'DB_CMS');
            $where["content_id"] = I("param.content_id");
            $fields = "content_id,name,pic_url,text,link,obj_url,product_id,start_time,end_time,sortby";
            $data = $cms->where($where)->field($fields)->select();
            if($data){
                $result["data"] = $data;
                $result["result"] = 1;
                $result["dis"] = "操作成功";
            }else{
                $result["result"] = -1;
                $result["dis"] = "操作失败";            
            }
        }else{
            $result["result"] = -1;
            $result["dis"] = "content_id不能为空";
        }
        echo json_encode($result);exit;
    }
    //添加推广
    public function addContent() {
        if(isset($_FILES["pic_url"]) && !empty($_FILES["pic_url"])){
                $file_name = $_FILES["pic_url"]["tmp_name"];
                $return_array = fdfs_upload($file_name);
                if($return_array["res"] == 1){
                    $data["pic_url"] = $return_array["data"];
                }else{
                    $return["result"] = -1;
                    $return["dis"] = "文件上传失败";
                    echo json_encode($return);exit; 
                }
        }
        if(I("param.")){
            $data = I("param.");
            $cms=M('ad_content', '', 'DB_CMS');
            $now_date = date("Y-m-d H:m:i",time());
            $data["is_enabled"] = 1;
            $data["creation_time"] = $now_date;
            $data["modification_time"] = $now_date;
            $res = $cms->add($data);
            if($res){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "没有参数";
        }
        echo json_encode($return);exit; 
    }
    //编辑推广
    public function editContent() {
        if(isset($_FILES["pic_url"]) && !empty($_FILES["pic_url"])){
                $file_name = $_FILES["pic_url"]["tmp_name"];
                $return_array = fdfs_upload($file_name);
                if($return_array["res"] == 1){
                    $data["pic_url"] = $return_array["data"];
                }else{
                    $return["result"] = -1;
                    $return["dis"] = "文件上传失败";
                    echo json_encode($return);exit; 
                }
        }
        if(I("param.")){
            $data = I("param.");
            $cms=M('ad_content', '', 'DB_CMS');
            $now_date = date("Y-m-d H:m:i",time());
            $data["is_enabled"] = 1;
            $data["modification_time"] = $now_date;
            $res = $cms->save($data);
            $return = array();
            if($res){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "没有参数";
        }              
        echo json_encode($return);exit; 
    }
    //删除推广
    public function delContent() {
        if(I("param.content_id") && I("param.content_id") > 0){
            $cms=M('ad_content', '', 'DB_CMS');
            $where["content_id"] = $_GET["content_id"];
            $where["is_enabled"] = -1;
            $result = $cms->save($where);
            if($result){
                $return["result"] = 1;
                $return["dis"] = "操作成功";
            }else{
                $return["result"] = -1;
                $return["dis"] = "操作数据库失败";
            }
        }else{
            $return["result"] = -1;
            $return["dis"] = "page_id不能为空";
        }
        echo json_encode($return);exit;
    }
    //前台调用获取广告位
    public function getAdvert(){
        if(I("param.")){
            $result["data"] = array();
            $cms=M('', '', 'DB_CMS');
            $sql = "select content_id,name,pic_url,text,link,obj_url,product_id,start_time,end_time from ad_content where is_enabled=1";
            if(I("param.page_id")){
                $position_id = $cms->table("ad_position")->where("page_id=".I("param.page_id"))->field("position_id")->select();
                $str = "";
                foreach($position_id as $key=>$val){
                    $str.=$val["position_id"].",";
                }
                $position_id_str = trim($str,",");
                $sql.= " and position_id in (".$position_id_str.")";
            }        
            if(I("param.positoin_id")){
                $sql .= " and positoin_id=".I("param.positoin_id");
            }     
            if(I("param.content_id")){
                $sql .= " and content_id=".I("param.content_id");
            }
            if(I("param.start_time")){
                $sql .= " and start_time>=".I("param.start_time");
            }
            if(I("param.end_time")){
                $sql .= " and end_time<=".$_GET["end_time"];
            }
            if(I("param.orderby")){
                $sql .= " order by  orderby".I("param.orderby");
            }
            if(I("param.count")){
            $sql .= " limit ".I("param.count");
            }
            //echo $sql;die;
            $data = $cms->query($sql);
            if($data){
                foreach($data as $key=>$value){
                    $pro = M('', '', 'DB_PRODUCT');
                    $query["product_id"] = $value["product_id"];
                    $join_a = "product_image_map b on a.product_id = b.product_id";
                    $fields = "a.product_name,a.standard_price,a.chunbo_price,a.product_area,b.product_path";
                    $product_array = $pro->table("product a")->join($join_a)->where($query)->field($fields)->find();
                    if($product_array){
                        $data[$key]["product_name"] = $product_array["product_name"];
                        $data[$key]["standard_price"] = $product_array["standard_price"];
                        $data[$key]["chunbo_price"] = $product_array["chunbo_price"];
                        $data[$key]["product_area"] = $product_array["product_area"];
                        $data[$key]["product_area"] = C("download_server").$product_array["product_area"];
                        $data[$key]["product_link"] = C("download_server").$value["product_id"];
                    }
                }
                $result["data"] = $data;
                $result["result"] = 1;
                $result["dis"] = "操作成功";
            }else{
                $result["result"] = -1;
                $result["dis"] = "操作失败";            
            }
        }else{
             $result["result"] = -1;
             $result["dis"] = "操作失败";      
        }
        echo json_encode($result);exit;
    }
    //文件上传测试
    function addImage(){
        if(I("param.") || $_FILES){
            $tmp_name  =  $_FILES [ "pic_url" ][ "tmp_name" ];
            $link = fdfs_upload($tmp_name,"jpg");
            if($link){
                $this->assign("img",C("download_server").$link["data"]);
            }else{
                echo "上传失败";
            }
        }
        $this->display();
    }*/
    
    /**
     ** cms:帮助中心 
    **/
    
    //帮助中心新增分类
    public function addCategory(){
        
        //分类名
        if(I("display_name")){
            
            $display_name = $data['display_name'] = I("display_name");
        }else{
            
            //分类名为空
            $error = 1;
            exit(json_encode(array("error"=>$error)));
        }
        
        //分类排序
        if(I("priority")){
            
            $priority = I("priority");
                
            if((int)$priority){  //整数时
                
                $data['priority'] = $priority = (int)$priority;
            }else{  //非整数时排序设置为1
               
                $data['priority'] = $priority = 1;
            }
        }else{
            
            //排序值为空时设置为1
            $priority = $data['priority'] = 1;
        }
        
        //添加时间
        $data['creation_time'] = date("Y-m-d H:i:s",time());
        
        $cmsObject = M("Help_category");
        $cmsObject->create();
        if($cmsObject->data($data)->add()){ //新增成功
           
            $flag = 1;
            exit(json_encode(array("flag"=>$flag)));
        }else{  //新增失败
            
            $flag = 0;
            exit(json_encode(array("flag"=>$flag)));
        }
    }

    //帮助中心新增内容
    public function addTopic(){
        
        //所属分类id
        if(I("help_category_id")){
            
            $help_category_id = $data['help_category_id'] = I("help_category_id");
            
            //查找数据表中是否存在help_category_id
            $helpObj = M("Help_category");
            $helpObj->create();
            $count = $helpObj->where('help_category_id = '.$help_category_id)->count();

            if($count == 0){    //对应的所属分类id不存在
                
                $error = 1;
                exit(json_encode(array("error"=>$error)));
            }else{      
                
                $help_category_id = $data['help_category_id'] = I("help_category_id");
            }
        }else{  //所属分类id为空
            
            $error = 1;
            exit(json_encode(array("error"=>$error)));
        }
        
        //标题
        if(I("title")){
            
            $title = $data['title'] = I("title");
        }else{  //title为空
            
            $error = 2;
            exit(json_encode(array("error"=>$error)));
        }
        
        //描述
        if(I("description")){
            
            $description = $data['description'] = I("description");
        }
        
        //顺序
        if(I("priority")){
            
            $priority =  I("priority");
            if((int)$priority){
                
                $priority = $data['priority'] = (int)$priority;
            }
        }else{
            
            $priority = 1;
        }
        
        //内容
        if(I("content")){
            
            $content = $data['content'] = I("content");
        }else{
            
            $error = 3;
            exit(json_encode(array("error"=>$error)));
        }
        
        //添加时间
        $data['creation_time'] = date("Y-m-d H:i:s",time());
        
        $helpTopicObj = M("help_topic");
        $helpTopicObj->create();
        if($helpTopicObj->data($data)->add()){ //新增成功
           
            $flag = 1;
            exit(json_encode(array("flag"=>$flag)));
        }else{  //新增失败
            
            $flag = 0;
            exit(json_encode(array("flag"=>$flag)));
        }
        
        
    }
    
    
    //获取帮助中心列表
    public function getList(){
        
        if(I("help_category_id") || I("title")){    //带参数查询
            
            //查询条件
            $where = "";
            $f = 0; //用于多个参数的表示
            
            //类别id
            if(I("help_category_id")){

                $f = 1;
                $help_category_id = I("help_category_id");
                $where .= "help_category.help_category_id = ".$help_category_id;
            }
            
            //标题
            if(I("title")){
                
                $title = I("title");
                
                if($f == 1){
                    
                    $where .= " and help_topic.title = '".$title."'";
                    
                }else if($f == 0){
                    
                    $where .= " help_topic.title = '".$title."'";
                }     
            }
                       
            //实例化 帮助中心类别表
            $categoryObj = M("Help_category");
            $categoryObj->create();
                                  
            $join = "Left join help_topic on help_category.help_category_id = help_topic.help_category_id";
            $field = "help_category.help_category_id,help_category.display_name,help_category.priority as category_priority,help_category.is_enabled as category_is_enabled,help_topic.topic_id,help_topic.title,help_topic.priority as topic_priority,help_topic.is_enabled as topic_is_enabled";
              
            $count = $categoryObj->join($join)->where($where)->count();
            if($count == 0){
                
                $flag = 0;
                exit(json_encode(array("flag"=>$flag)));
            }else{
                
                $list = $categoryObj
                        ->join($join)
                        ->field($field)
                        ->where($where)
                        ->select();
                exit(json_encode(array("list"=>$list)));
            }              
            
        }else{  //不带参数获取列表
            
            //实例化 帮助中心类别表
            $categoryObj = M("Help_category");
            $categoryObj->create();
                                  
            $join = "Left join help_topic on help_category.help_category_id = help_topic.help_category_id";
            $field = "help_category.help_category_id,help_category.display_name,help_category.priority as category_priority,help_category.is_enabled as category_is_enabled,help_topic.topic_id,help_topic.title,help_topic.priority as topic_priority,help_topic.is_enabled as topic_is_enabled";
            
            $count = $categoryObj->join($join)->count();
            if($count == 0){
                
                $flag = 0;
                exit(json_encode(array("flag"=>$flag)));
            }else{
                
                $list = $categoryObj
                        ->join($join)
                        ->field($field)
                        ->select();
                exit(json_encode(array("list"=>$list)));
            }  
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
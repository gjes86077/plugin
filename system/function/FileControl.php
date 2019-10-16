<?
//栽圖
function wrap_img($file_data,$file_path="../../upload/",$file_name){
    ini_set("memory_limit","200M");
    $file_name = $file_name.".png";
    $img = str_replace('data:image/png;base64,', '', $file_data);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    file_put_contents($file_path.$file_name, $data);
}

//UUID
function uuid($prefix = '')
{
    $str = md5(uniqid(mt_rand(), true));
    $uuid = substr($str, 0, 8).'-';
    $uuid .= substr($str, 8, 4).'-';
    $uuid .= substr($str, 12, 4).'-';
    $uuid .= substr($str, 16, 4).'-';
    $uuid .= substr($str, 20, 12);
    $uuid =! empty($prefix) ? $prefix . '-' . $uuid : $uuid;
    $uiud = strtoupper($uuid);

    return $uuid;
}
//取得Youtube ID
function video_id($url)
{
    $parse_url = parse_url($url);
    $query = [];
    parse_str($parse_url['query'], $query);
    if (! empty($query['v'])) {
        return $query['v'];
    }
    $t = explode('/', trim($parse_url['path'], '/'));
    foreach ($t as $k => $v) {
        if ($v == 'v') {
            if (! empty($t[$k + 1])) {
                return $t[$k + 1];
            }
        }
    }
    return $url;
}
function fileimg($filesKey_key,$db_name,$path="../../upload/",$img="img"){
    $post=$_POST;
    $filesKey   = array($filesKey_key);
    $filesArray   = $_FILES;
    if(!checkConvey($filesArray, $filesKey)){
        var_dump($filesArray);
        var_dump($filesKey);
        echo "error = 100-1";
        exit();
    }
    //移除無定義的key值
    $filesArray = checkKey($filesArray, $filesKey);
    //上傳檔案-重組陣列
    $filesArray = uploadFile($filesArray,$path);
    if($filesArray===false){
        echo "error = 110-1";
        exit();
    } else {
        $error = '';
        $tmp = $filesArray;
        foreach($tmp as $key => $file) {
            if (is_array($file) && $file['id'] != 4) {
                switch($key) {
                    case 'image':
                        $error .= '圖片：';
                        break;
                }
                $error .= $file['msg'] . '<br>';
                unset($filesArray[$key]);
            }
            if (is_array($file) && $file['id'] == 4) {
                unset($filesArray[$key]);
            }
        }
        if (!empty($error)) {
            echo $error;
            exit();
        }
    }
    $post = array_merge($post,$filesArray);
    if(array_key_exists($filesKey_key, $post)){
        $post[$img]=$post[$filesKey_key];
        $img_tb=SelectCondition($link,$db_name,'id',$post['id']);
        $path="../../upload/".$img_tb[0][$img];
        if(file_exists($path))
        {unlink($path);}
    }
    else
    {
        $post[$img]=$post[$img];
    }

    unset($post[$filesKey_key]);

    return $post[$img];
}
function uploadFile($filesArray,$path="../../upload/",$typeString = "") {
        $newArray   = array();
        $typeArray  = explode(",", $typeString);
        $count      = rand(0,1000);
        if (!file_exists($path))
            mkdir($path, 0777, true);  // 建立目錄
        foreach ($filesArray as $key => $val) {
            if (is_array($val["error"])) {
                foreach ($val["error"] as $key2 => $val2) {
                    if($val["error"][$key2] == 0){
                        //取出副檔名
                        $a = explode(".", $val["name"][$key2]);
                        $dwg = end($a);
                        //判斷檔案類型
                        if ($typeString) {
                            $typeString = "gif,jpe,jpeg,jpg,png,pdf,doc,docx,xls,xlsx" . $typeString;
                        } else {
                            $typeString = "gif,jpe,jpeg,jpg,png,pdf,doc,docx,xls,xlsx";
                        }
                        if (!preg_match("/$dwg/", $typeString)) {
                            return false;
                        }

                        //設定字串為日期加時間，用於檔案名稱
                        $time = date("Y_m_d_His") . $count;
                        //重新為檔案命名
                        $name = $time . "." . $dwg;
                        //暫存資料夾
                        $filename = $val["tmp_name"][$key2];
                        //目的地+檔名
                        $destination =$path . $name;
                        //搬移
                        if (!copy($filename, $destination)) {
                            return false;
                        }
                        chmod($destination, 755);
                        //組合陣列
                        $newArray[$key][$key2] = $name;
                        //$count++;
                    } else {
                        $result = array('id' => (int)$val["error"][$key2]);
                        switch($result['id']) {
                            case 1:
                                $result['msg'] = '檔案大小超出了伺服器上傳限制 (' . ini_get('upload_max_filesize') . ')。';
                            break;
                            case 2:
                                $result['msg'] = '要上傳的檔案大小超出瀏覽器限制。';
                            break;
                            case 3:
                                $result['msg'] = '檔案僅部分被上傳。';
                            break;
                            case 4:
                                $result['msg'] = '沒有找到要上傳的檔案。';
                            break;
                            case 5:
                                $result['msg'] = '伺服器臨時檔案遺失。';
                            break;
                            case 6:
                                $result['msg'] = '檔案寫入到暫存資料夾錯誤。';
                            break;
                            case 7:
                                $result['msg'] = '無法上傳。';
                            break;
                            case 8:
                                $result['msg'] = 'UPLOAD_ERR_EXTENSION 錯誤。';
                            break;
                            default:
                                $result['msg'] = '未知錯誤。';
                            break;
                        }
                        $newArray[$key][$key2] = $result;
                    }
                }
            } else {
                if ($val["error"] == 0) {
                    //取出副檔名
                    $a = explode(".", $val["name"]);
                    $dwg = end($a);
                    //判斷檔案類型
                    if ($typeString) {
                        $typeString = "doc,ppt,jpeg,jpg,png,pdf,dwg" . $typeString;
                    } else {
                        $typeString ="gif,jpe,jpeg,jpg,png,pdf,doc,docx,xls,xlsx";
                    }
                    if (!preg_match("/$dwg/i", $typeString)) {
                        return false ;
                    }

                    //設定字串為日期加時間，用於檔案名稱
                    date_default_timezone_set("Asia/Taipei");
                    $time = date("Y_m_d_His") . $count;
                    //重新為檔案命名
                    $name = $time . "." . $dwg;
                    //暫存資料夾
                    $filename = $val["tmp_name"];
                    //目的地+檔名
                    $destination = $path.$name;
                    //搬移

                    move_uploaded_file($filename, $destination);
                    //組合陣列
                    $newArray[$key] = $name;
                    $count++;
                } else {
                    $result = array('id' => (int)$val["error"]);
                    switch($result['id']) {
                        case 1:
                            $result['msg'] = '檔案大小超出了伺服器上傳限制 (' . ini_get('upload_max_filesize') . ')。';
                            break;
                        case 2:
                            $result['msg'] = '要上傳的檔案大小超出瀏覽器限制。';
                            break;
                        case 3:
                            $result['msg'] = '檔案僅部分被上傳。';
                            break;
                        case 4:
                            $result['msg'] = '沒有找到要上傳的檔案。';
                            break;
                        case 5:
                            $result['msg'] = '伺服器臨時檔案遺失。';
                            break;
                        case 6:
                            $result['msg'] = '檔案寫入到暫存資料夾錯誤。';
                            break;
                        case 7:
                            $result['msg'] = '無法上傳。';
                            break;
                        case 8:
                            $result['msg'] = 'UPLOAD_ERR_EXTENSION 錯誤。';
                            break;
                        default:
                            $result['msg'] = '未知錯誤。';
                            break;
                    }
                    $newArray[$key] = $result;
                }
            }
        }
        return $newArray ;
    }
function uploadfiles($file,$uploadPath='../../upload/docs/'){
    $fileCount = count($_FILES[$file]['name']);
    if (!file_exists($uploadPath))
        mkdir($uploadPath, 0777, true);  // 建立目錄

    if ($fileCount>=1 and $_FILES[$file]['name'][0]!='') {
        for ($i = 0; $i < $fileCount; $i++) {
            # 檢查檔案是否上傳成功
            if ($_FILES[$file]['error'][$i] === UPLOAD_ERR_OK){
                # 檢查檔案是否已經存在
                if (file_exists($uploadPath . $_FILES[$file]['name'][$i])){
                    $a = explode(".", $_FILES[$file]['name'][$i]);
                    $name = reset($a);
                    $ext = strtolower(end($a));
                    $_FILES[$file]['name'][$i]=$name.rand().'.'.$ext;
                }
                $fileArray[$i]['File']=$_FILES[$file]['name'][$i];
                $fileArray[$i]['Ext']=$_FILES[$file]['type'][$i];
                $temp_file = $_FILES[$file]['tmp_name'][$i];
                $dest = $uploadPath . $_FILES[$file]['name'][$i];
                # 將檔案移至指定位置
                $typeString = "gif,jpe,jpeg,jpg,png,pdf,doc,docx,xls,xlsx" ;
                if (!preg_match("/$ext/", $typeString)) {
                    echo "上傳檔案類型不符";
                    exit();
                }
                //移動檔案至指令位置
                move_uploaded_file($temp_file, $dest);
            }
            else {
                echo '錯誤代碼：' . $_FILES[$file]['error'] . '<br/>';
                exit();
            }
        }
        return $fileArray;
    }
}
?>

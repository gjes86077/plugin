<?php
//栽圖
function wrap_img($file_data, $file_path = "../../upload/", $file_name)
{
    ini_set("memory_limit", "200M");
    $file_name = $file_name . ".png";
    $img       = str_replace('data:image/png;base64,', '', $file_data);
    $img       = str_replace(' ', '+', $img);
    $data      = base64_decode($img);
    file_put_contents($file_path . $file_name, $data);
    return $file_name . '.png';
}

//UUID
function uuid($prefix = '')
{
    $str  = md5(uniqid(mt_rand(), true));
    $uuid = substr($str, 0, 8) . '-';
    $uuid .= substr($str, 8, 4) . '-';
    $uuid .= substr($str, 12, 4) . '-';
    $uuid .= substr($str, 16, 4) . '-';
    $uuid .= substr($str, 20, 12);
    $uuid = !empty($prefix) ? $prefix . '-' . $uuid : $uuid;
    $uiud = strtoupper($uuid);

    return $uuid;
}
//取得Youtube ID
function video_id($url)
{
    $parse_url = parse_url($url);
    $query     = [];
    parse_str($parse_url['query'], $query);
    if (!empty($query['v'])) {
        return $query['v'];
    }
    $t = explode('/', trim($parse_url['path'], '/'));
    foreach ($t as $k => $v) {
        if ($v == 'v') {
            if (!empty($t[$k + 1])) {
                return $t[$k + 1];
            }
        }
    }
    return $url;
}
function uploading($filesKey, $org = "original", $path = "../../upload/")
{
    $P = CheckAll($_POST, [$filesKey, $org]);
    $F = $_FILES;
    // 判斷是否有上傳檔案
    if ($F[$filesKey]['error'] != 4) {
        $uploadResult = uploadFile($F[$filesKey], $path);
        if ($uploadResult['status']) {
            $fileName = $uploadResult['fileName'];
            //刪除舊檔案
            if (file_exists($path . $org)) {
                unlink($path . $org);
            }

        } else {
            echo json_encode($uploadResult);
            exit;
        }

    } else {
        // 無上傳任何檔案則回傳原始值
        $fileName = $P[$org];
    }

    return $fileName;
}
function uploadFile($file, $path = "../../upload/", $allowType = "")
{
    $allowType = empty($allowType) ? "gif,jpe,jpeg,jpg,png,pdf,doc,docx,xls,xlsx" : $allowType;
    $allowType = explode(",", $allowType);
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    // 建立目錄
    if (!is_array($file["error"])) {
        if ($file["error"] == 0) {
            //取出副檔名
            $a   = explode(".", $file["name"]);
            $dwg = end($a);
            //判斷檔案類型
            if (!in_array($dwg, $allowType)) {
                $errorMsg = implode(", ", $allowType);
                return [
                    "msg"    => "不允許 {$dwg} 格式，僅允許上傳 {$errorMsg} 檔案格式。",
                    'status' => false,
                ];

            }

            //設定字串為日期加時間，用於檔案名稱
            $fileName    = uuid('file');
            $fileName    = "{$fileName}.{$dwg}";
            $tmp         = $file["tmp_name"];
            $destination = $path . $fileName;
            // var_dump($destination);exit();
            //搬移
            if (!copy($tmp, $destination)) {

                return [
                    "msg"    => "檔案傳送期間出現錯誤。",
                    'status' => false,
                ];

            }
            chmod($destination, 755);
            //組合陣列
            $result = [
                "fileName" => $fileName,
                'status'   => true,
            ];

            //$count++;
        } else {
            $result['status'] = false;
            switch ($file["error"]) {
                case 1:
                    $result['msg'] = "檔案大小超出了伺服器上傳限制 (" . ini_get('upload_max_filesize') . ")。";
                    break;
                case 2:
                    $result['msg'] = "要上傳的檔案大小超出瀏覽器限制。";
                    break;
                case 3:
                    $result['msg'] = "檔案僅部分被上傳。";
                    break;
                case 4:
                    $result['msg'] = "沒有找到要上傳的檔案。";
                    break;
                case 5:
                    $result['msg'] = "伺服器臨時檔案遺失。";
                    break;
                case 6:
                    $result['msg'] = "檔案寫入到暫存資料夾錯誤。";
                    break;
                case 7:
                    $result['msg'] = "無法上傳。";
                    break;
                case 8:
                    $result['msg'] = "UPLOAD_ERR_EXTENSION 錯誤。";
                    break;
                default:
                    $result['msg'] = "未知錯誤。";
                    break;
            }
            return $result;
        }
    }
    return $result;
}

function uploadfiles($file, $uploadPath = '../../upload/docs/')
{
    $fileCount = count($_FILES[$file]['name']);
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    // 建立目錄

    if ($fileCount >= 1 and $_FILES[$file]['name'][0] != '') {
        for ($i = 0; $i < $fileCount; $i++) {
            # 檢查檔案是否上傳成功
            if ($_FILES[$file]['error'][$i] === UPLOAD_ERR_OK) {
                # 檢查檔案是否已經存在
                if (file_exists($uploadPath . $_FILES[$file]['name'][$i])) {
                    $a                         = explode(".", $_FILES[$file]['name'][$i]);
                    $name                      = reset($a);
                    $ext                       = strtolower(end($a));
                    $_FILES[$file]['name'][$i] = $name . rand() . '.' . $ext;
                }
                $fileArray[$i]['File'] = $_FILES[$file]['name'][$i];
                $fileArray[$i]['Ext']  = $_FILES[$file]['type'][$i];
                $temp_file             = $_FILES[$file]['tmp_name'][$i];
                $dest                  = $uploadPath . $_FILES[$file]['name'][$i];
                # 將檔案移至指定位置
                $typeString = "gif,jpe,jpeg,jpg,png,pdf,doc,docx,xls,xlsx";
                if (!preg_match("/$ext/", $typeString)) {
                    echo "上傳檔案類型不符";
                    exit();
                }
                //移動檔案至指令位置
                move_uploaded_file($temp_file, $dest);
            } else {
                echo '錯誤代碼：' . $_FILES[$file]['error'] . '<br/>';
                exit();
            }
        }
        return $fileArray;
    }
}

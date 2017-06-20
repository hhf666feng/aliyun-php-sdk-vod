<?php

require_once 'vendor/autoload.php';

use vod\Request\V20170321 as vod;

$regionId = 'cn-shanghai';
$access_key_id = '';
$access_key_secret = '';

$profile = DefaultProfile::getProfile($regionId, $access_key_id, $access_key_secret);
$client = new DefaultAcsClient($profile);

/**
 * Get video upload credentials and addresses.
 *
 * @param \DefaultAcsClient $client
 * @param string $regionId
 * @return mixed|SimpleXMLElement
 */
function create_upload_video($client, $regionId) {
    $request = new vod\CreateUploadVideoRequest();
    $request->setAcceptFormat('JSON');
    $request->setRegionId($regionId);
    $request->setTitle("视频标题");
    //视频源文件名称(必须包含扩展名)
    $request->setFileName("文件名称.mov");
    //视频源文件字节数
    $request->setFileSize(0);
    $request->setDescription("视频描述");
    //自定义视频封面URL地址
    $request->setCoverURL("http://cover.sample.com/sample.jpg");
    //上传所在区域IP地址
    $request->setIP("127.0.0.1");
    $request->setTags("标签1,标签2");
    //视频分类ID
    $request->setCateId(0);
    $response = $client->getAcsResponse($request);
    return $response;
}

/**
 * Refresh video upload credentials.
 *
 * @param \DefaultAcsClient $client
 * @param $regionId
 * @return mixed|SimpleXMLElement
 */
function refresh_upload_video($client, $regionId) {
    $request = new vod\RefreshUploadVideoRequest();
    $request->setAcceptFormat('JSON');
    $request->setRegionId($regionId);
    $request->setVideoId("视频ID");
    $response = $client->getAcsResponse($request);
    return $response;
}

create_upload_video($client, $regionId);
refresh_upload_video($client, $regionId);
<?php 
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json'),1);
$id = $config['words'];
$file = $config['for'];
$a = file_exists('a') ? file_get_contents('a') : 'ap';
if($a == 'new'){
	file_put_contents($file, '');
}
$from = 'Following';
$mid = bot('sendMessage',[
	'chat_id'=>$config['id'],
	'message_id'=>$mid,
	'text'=>"Grab From $from - Running\nUsers - ".count(explode("\n", file_get_contents($file)))."",
	'parse_mode'=>'markdown',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
			[['text'=>'Stop Grab','callback_data'=>'stopgr']]
		]])
])->result->message_id;
$ids = explode(' ', $config['words']);
foreach($ids as $user){
	echo $user."\n";
	sleep(0);
	$cookies = $accounts[$file];
	$ig = new ig(['account'=>$accounts[$file],'file'=>$file]);
	$info = $ig->getInfo($user);
	$id = $info->pk;
	$ig->getFollowing($id,$mid,$user);
}
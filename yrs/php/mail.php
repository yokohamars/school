<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php //error_reporting(E_ALL | E_STRICT);
##-----------------------------------------------------------------------------------------------------------------##
#
#  PHP���[���v���O�����@�t���[�� �ŏI�X�V��2014/12/12
#�@��������ς͎��ȐӔC�ōs���Ă��������B
#	
#  ���̂Ƃ�����ɖ��_�͂���܂��񂪁A�s���������܂����牺�L�܂ł��A�����������B
#  MailAddress: info@php-factory.net
#  name: K.Numata
#  HP: http://www.php-factory.net/
#
#  �d�v�I�I�T�C�g�Ń`�F�b�N�{�b�N�X���g�p����ꍇ�݂̂ł����B�B�B
#  �`�F�b�N�{�b�N�X���g�p����ꍇ��input�^�O�ɋL�q����name�����̒l��K���z��̌`�ɂ��Ă��������B
#  ��@name="���T�C�g����������������[]"  �Ƃ��ĉ������B
#  name�̒l�̍Ō��[��]��t����B����Ȃ��ƕ����̒l���擾�ł��܂���I
#
##-----------------------------------------------------------------------------------------------------------------##
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {//PHP5.1.0�ȏ�̏ꍇ�̂݃^�C���]�[�����`
	date_default_timezone_set('Asia/Tokyo');//�^�C���]�[���̐ݒ�i���{�ȊO�̏ꍇ�ɂ͓K�X�ݒ肭�������j
}
/*-------------------------------------------------------------------------------------------------------------------
* ���ȉ��ݒ莞�̒��ӓ_�@
* �E�l�i=�̌�j�͐����ȊO�̕�����i�ꕔ�������j�̓_�u���N�I�[�e�[�V�����u"�v�A�܂��́u'�v�ň͂�ł��܂��B
* �E��������O������폜�����肵�Ȃ��ł��������B���̃Z�~�R�����u;�v���폜���Ȃ����������B
* �E�܂��擪�Ɂu$�v���t����������͕ύX���Ȃ��ł��������B������1�܂���0�Őݒ肵�Ă�����͕̂K�����p�����Őݒ艺�����B
* �E���[���A�h���X��name�����̒l���uEmail�v�ł͂Ȃ��ꍇ�A�ȉ��K�{�ݒ�ӏ��́u$Email�v�̒l���ύX�������B
* �Ename�����̒l�ɔ��p�X�y�[�X�͎g�p�ł��܂���B
*�ȏ�̂��Ƃ��ԈႦ�Ă��܂��ƃv���O���������삵�Ȃ��Ȃ�܂��̂Œ��Ӊ������B
-------------------------------------------------------------------------------------------------------------------*/


//---------------------------�@�K�{�ݒ�@�K���ݒ肵�Ă��������@-----------------------

//�T�C�g�̃g�b�v�y�[�W��URL�@���f�t�H���g�ł͑��M������Ɂu�g�b�v�y�[�W�֖߂�v�{�^�����\������܂��̂�
$site_top = "http://yrs.boy.jp/";

// �Ǘ��҃��[���A�h���X �����[�����󂯎�郁�[���A�h���X(�����w�肷��ꍇ�́u,�v�ŋ�؂��Ă������� �� $to = "aa@aa.aa,bb@bb.bb";)
$to = "commissioner@yrs.boy.jp";

//�t�H�[���̃��[���A�h���X���͉ӏ���name�����̒l�iname="����"�@�́��������j
$Email = "Email";

/*------------------------------------------------------------------------------------------------
�ȉ��X�p���h�~�̂��߂̐ݒ�@
���L���ɂ���ɂ͂��̃t�@�C���ƃt�H�[���y�[�W������h���C�����ɂ���K�v������܂�
------------------------------------------------------------------------------------------------*/

//�X�p���h�~�̂��߂̃��t�@���`�F�b�N�i�t�H�[���y�[�W������h���C���ł��邩�ǂ����̃`�F�b�N�j(����=1, ���Ȃ�=0)
$Referer_check = 1;

//���t�@���`�F�b�N���u����v�ꍇ�̃h���C�� ���ȉ�����Q�l�ɐݒu����T�C�g�̃h���C�����w�肵�ĉ������B
$Referer_check_domain = "yrs.boy.jp";

//---------------------------�@�K�{�ݒ�@�����܂Ł@------------------------------------


//---------------------- �C�Ӑݒ�@�ȉ��͕K�v�ɉ����Đݒ肵�Ă������� ------------------------


// �Ǘ��҈��̃��[���ō��o�l�𑗐M�҂̃��[���A�h���X�ɂ���(����=1, ���Ȃ�=0)
// ����ꍇ�́A���[�����͗���name�����̒l���u$Email�v�Ŏw�肵���l�ɂ��Ă��������B
//���[���[�ȂǂŕԐM����ꍇ�ɕ֗��Ȃ̂Łu����v���������߂ł��B
$userMail = 1;

// Bcc�ő��郁�[���A�h���X(�����w�肷��ꍇ�́u,�v�ŋ�؂��Ă������� �� $BccMail = "aa@aa.aa,bb@bb.bb";)
$BccMail = "";

// �Ǘ��҈��ɑ��M����郁�[���̃^�C�g���i�����j
$subject = "���^���U���A���[";

// ���M�m�F��ʂ̕\��(����=1, ���Ȃ�=0)
$confirmDsp = 1;

// ���M������Ɏ����I�Ɏw��̃y�[�W(�T���N�X�y�[�W�Ȃ�)�Ɉړ�����(����=1, ���Ȃ�=0)
// CV������͂������ꍇ�Ȃǂ̓T���N�X�y�[�W��ʓr�p�ӂ��AURL�����̉��̍��ڂŎw�肵�Ă��������B
// 0�ɂ���ƁA�f�t�H���g�̑��M������ʂ��\������܂��B
$jumpPage = 0;

// ���M������ɕ\������y�[�WURL�i��L��1��ݒ肵���ꍇ�̂݁j��http����n�܂�URL�Ŏw�肭�������B
$thanksPage = "http://yrs.boy.jp/thanks.html";

// �K�{���͍��ڂ�ݒ肷��(����=1, ���Ȃ�=0)
$requireCheck = 0;

/* �K�{���͍���(���̓t�H�[���Ŏw�肵��name�����̒l���w�肵�Ă��������B�i��L��1��ݒ肵���ꍇ�̂݁j
�l�̓V���O���N�H�[�e�[�V�����ň͂݁A�����̏ꍇ�̓J���}�ŋ�؂��Ă��������B�t�H�[�����Ə��Ԃ����킹��Ɨǂ��ł��B 
�z��̌`�uname="����[]"�v�̏ꍇ�ɂ͕K������[]����������̂��w�肵�ĉ������B*/
$require = array('Type','����','�U����','���O','Email');


//----------------------------------------------------------------------
//  �����ԐM���[���ݒ�(START)
//----------------------------------------------------------------------

// ���o�l�ɑ��M���e�m�F���[���i�����ԐM���[���j�𑗂�(����=1, ����Ȃ�=0)
// ����ꍇ�́A�t�H�[�����̃��[�����͗���name�����̒l����L�u$Email�v�Ŏw�肵���l�Ɠ����ł���K�v������܂�
$remail = 1;

//�����ԐM���[���̑��M�җ��ɕ\������閼�O�@�����Ȃ��̖��O���Ж��Ȃǁi���������ԐM���[���̑��M�Җ���������������ꍇ�����͋�ɂ��Ă��������j
$refrom_name = "���l���O�r�[�X�N�[�����^��";

// ���o�l�ɑ��M�m�F���[���𑗂�ꍇ�̃��[���̃^�C�g���i��L��1��ݒ肵���ꍇ�̂݁j
$re_subject = "���^���肪�Ƃ��������܂�";

//�t�H�[�����́u���O�v�ӏ���name�����̒l�@�������ԐM���[���́u�����l�v�̕\���Ŏg�p���܂��B
//�w�肵�Ȃ��A�܂��͑��݂��Ȃ��ꍇ�́A�����l�ƕ\������Ȃ������ł��B�����Ė����ɂ��Ă�OK
$dsp_name = '���O';

//�����ԐM���[���̖`���̕��� �����{�ꕔ���̂ݕύX��
$remail_text = <<< TEXT

���^���Ɏ^�����Ē������肪�Ƃ��������܂��B
�U���m�F���ł�����A�o�^���[���ɘA�������Ē����܂��B

���M���e�͈ȉ��ɂȂ�܂��B

TEXT;


//�����ԐM���[���ɏ����i�t�b�^�[�j��\��(����=1, ���Ȃ�=0)���Ǘ��҈��ɂ��\������܂��B
$mailFooterDsp = 1;

//��L�Łu1�v��I�����ɕ\�����鏐���i�t�b�^�[�j�iFOOTER�`FOOTER;�̊ԂɋL�q���Ă��������j
$mailSignature = <<< FOOTER

��������������������������������������������
���l���O�r�[�X�N�[���@�o���S���@����
�@�@�@�@�@�@�@�@�@�@�@�L��S���@���r
���^���A�����[���t�H�[�������ԐM
��������������������������������������������

FOOTER;


//----------------------------------------------------------------------
//  �����ԐM���[���ݒ�(END)
//----------------------------------------------------------------------

//���[���A�h���X�̌`���`�F�b�N���s�����ǂ����B(����=1, ���Ȃ�=0)
//���f�t�H���g�́u����v�B���ɗ��R���Ȃ���ΕύX���Ȃ��ŉ������B���[�����͗���name�����̒l����L�u$Email�v�Ŏw�肵���l�ł���K�v������܂��B
$mail_check = 1;

//------------------------------- �C�Ӑݒ肱���܂� ---------------------------------------------


// �ȉ��̕ύX�͒m���̂�����̂ݎ��ȐӔC�ł��肢���܂��B


//----------------------------------------------------------------------
//  �֐����s�A�ϐ�������
//----------------------------------------------------------------------
$encode = "UTF-8";//���̃t�@�C���̕����R�[�h��`�i�ύX�s�j

if(isset($_GET)) $_GET = sanitize($_GET);//NULL�o�C�g����//
if(isset($_POST)) $_POST = sanitize($_POST);//NULL�o�C�g����//
if(isset($_COOKIE)) $_COOKIE = sanitize($_COOKIE);//NULL�o�C�g����//
if($encode == 'SJIS') $_POST = sjisReplace($_POST,$encode);//Shift-JIS�̏ꍇ�Ɍ�ϊ������̒u�����s
$funcRefererCheck = refererCheck($Referer_check,$Referer_check_domain);//���t�@���`�F�b�N���s

//�ϐ�������
$sendmail = 0;
$empty_flag = 0;
$post_mail = '';
$errm ='';
$header ='';

if($requireCheck == 1) {
	$requireResArray = requireCheck($require);//�K�{�`�F�b�N���s���Ԃ�l���󂯎��
	$errm = $requireResArray['errm'];
	$empty_flag = $requireResArray['empty_flag'];
}
//���[���A�h���X�`�F�b�N
if(empty($errm)){
	foreach($_POST as $key=>$val) {
		if($val == "confirm_submit") $sendmail = 1;
		if($key == $Email) $post_mail = h($val);
		if($key == $Email && $mail_check == 1 && !empty($val)){
			if(!checkMail($val)){
				$errm .= "<p class=\"error_messe\">�y".$key."�z�̓��[���A�h���X�̌`��������������܂���B</p>\n";
				$empty_flag = 1;
			}
		}
	}
}
  
if(($confirmDsp == 0 || $sendmail == 1) && $empty_flag != 1){
	
	//���o�l�ɓ͂����[�����Z�b�g
	if($remail == 1) {
		$userBody = mailToUser($_POST,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode);
		$reheader = userHeader($refrom_name,$to,$encode);
		$re_subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($re_subject,"JIS",$encode))."?=";
	}
	//�Ǘ��҈��ɓ͂����[�����Z�b�g
	$adminBody = mailToAdmin($_POST,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp);
	$header = adminHeader($userMail,$post_mail,$BccMail,$to);
	$subject = "=?iso-2022-jp?B?".base64_encode(mb_convert_encoding($subject,"JIS",$encode))."?=";
	
	mail($to,$subject,$adminBody,$header);
	if($remail == 1 && !empty($post_mail)) mail($post_mail,$re_subject,$userBody,$reheader);
}
else if($confirmDsp == 1){ 

/*�@���������M�m�F��ʂ̃��C�A�E�g���ҏW�@�I���W�i���̃f�U�C�����K�p�\�������@*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>�m�F���</title>
<style type="text/css">
/* ���R�ɕҏW������ */
#formWrap {
	width:700px;
	margin:0 auto;
	color:#555;
	line-height:120%;
	font-size:90%;
}
table.formTable{
	width:100%;
	margin:0 auto;
	border-collapse:collapse;
}
table.formTable td,table.formTable th{
	border:1px solid #ccc;
	padding:10px;
}
table.formTable th{
	width:30%;
	font-weight:normal;
	background:#efefef;
	text-align:left;
}
p.error_messe{
	margin:5px 0;
	color:red;
}
</style>
</head>
<body>

<!-- �� Header�₻�̑��R���e���c�Ȃǁ@�����R�ɕҏW�� ��-->

<!-- ��************ ���M���e�\�����@���ҏW�͎��ȐӔC�� ************ ��-->
<div id="formWrap">
<?php if($empty_flag == 1){ ?>
<div align="center">
<h4>���͂ɃG���[������܂��B���L�����m�F�̏�u�߂�v�{�^���ɂďC�������肢�v���܂��B</h4>
<?php echo $errm; ?><br /><br /><input type="button" value=" �O��ʂɖ߂� " onClick="history.back()">
</div>
<?php }else{ ?>
<h3>�m�F���</h3>
<p align="center">�ȉ��̓��e�ŊԈႢ���Ȃ���΁A�u���M����v�{�^���������Ă��������B</p>
<form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="POST">
<table class="formTable">
<?php echo confirmOutput($_POST);//���͓��e��\��?>
</table>
<p align="center"><input type="hidden" name="mail_set" value="confirm_submit">
<input type="hidden" name="httpReferer" value="<?php echo h($_SERVER['HTTP_REFERER']);?>">
<input type="submit" value="�@���M����@">
<input type="button" value="�O��ʂɖ߂�" onClick="history.back()"></p>
</form>
<?php } ?>
</div><!-- /formWrap -->
<!-- �� *********** ���M���e�m�F���@���ҏW�͎��ȐӔC�� ************ ��-->

<!-- �� Footer���̑��R���e���c�Ȃǁ@���ҏW�� ��-->
</body>
</html>
<?php
/* ���������M�m�F��ʂ̃��C�A�E�g�@���I���W�i���̃f�U�C�����K�p�\�������@*/
}

if(($jumpPage == 0 && $sendmail == 1) || ($jumpPage == 0 && ($confirmDsp == 0 && $sendmail == 0))) { 

/* ���������M������ʂ̃��C�A�E�g�@�ҏW�� �����M������Ɏw��̃y�[�W�Ɉړ����Ȃ��ꍇ�̂ݕ\���������@*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>�������</title>
</head>
<body>
<div align="center">
<?php if($empty_flag == 1){ ?>
<h4>���͂ɃG���[������܂��B���L�����m�F�̏�u�߂�v�{�^���ɂďC�������肢�v���܂��B</h4>
<div style="color:red"><?php echo $errm; ?></div>
<br /><br /><input type="button" value=" �O��ʂɖ߂� " onClick="history.back()">
</div>
</body>
</html>
<?php }else{ ?>
���M���肪�Ƃ��������܂����B<br />
���M�͐���Ɋ������܂����B<br /><br />
<a href="<?php echo $site_top ;?>">�g�b�v�y�[�W�֖߂�&raquo;</a>
</div>
<?php copyright(); ?>
<!--  CV�����v������ꍇ������Analytics�R�[�h��\��t�� -->
</body>
</html>
<?php 
/* ���������M������ʂ̃��C�A�E�g �ҏW�� �����M������Ɏw��̃y�[�W�Ɉړ����Ȃ��ꍇ�̂ݕ\���������@*/
  }
}
//�m�F��ʖ����̏ꍇ�̕\���A�w��̃y�[�W�Ɉړ�����ݒ�̏ꍇ�A�G���[�`�F�b�N�Ŗ�肪������Ύw��y�[�W�w���_�C���N�g
else if(($jumpPage == 1 && $sendmail == 1) || $confirmDsp == 0) { 
	if($empty_flag == 1){ ?>
<div align="center"><h4>���͂ɃG���[������܂��B���L�����m�F�̏�u�߂�v�{�^���ɂďC�������肢�v���܂��B</h4><div style="color:red"><?php echo $errm; ?></div><br /><br /><input type="button" value=" �O��ʂɖ߂� " onClick="history.back()"></div>
<?php 
	}else{ header("Location: ".$thanksPage); }
}

// �ȉ��̕ύX�͒m���̂�����̂ݎ��ȐӔC�ł��肢���܂��B

//----------------------------------------------------------------------
//  �֐���`(START)
//----------------------------------------------------------------------
function checkMail($str){
	$mailaddress_array = explode('@',$str);
	if(preg_match("/^[\.!#%&\-_0-9a-zA-Z\?\/\+]+\@[!#%&\-_0-9a-z]+(\.[!#%&\-_0-9a-z]+)+$/", "$str") && count($mailaddress_array) ==2){
		return true;
	}else{
		return false;
	}
}
function h($string) {
	global $encode;
	return htmlspecialchars($string, ENT_QUOTES,$encode);
}
function sanitize($arr){
	if(is_array($arr)){
		return array_map('sanitize',$arr);
	}
	return str_replace("\0","",$arr);
}
//Shift-JIS�̏ꍇ�Ɍ�ϊ������̒u���֐�
function sjisReplace($arr,$encode){
	foreach($arr as $key => $val){
		$key = str_replace('�_','�[',$key);
		$resArray[$key] = $val;
	}
	return $resArray;
}
//���M���[����POST�f�[�^���Z�b�g����֐�
function postToMail($arr){
	global $hankaku,$hankaku_array;
	$resArray = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//�A�����ڂ̏���
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//�`�F�b�N�{�b�N�X�i�z��j�ǋL�����܂�
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		
		//�S�p�����p�ϊ�
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		if($out != "confirm_submit" && $key != "httpReferer") {
			$resArray .= "�y ".h($key)." �z ".h($out)."\n";
		}
	}
	return $resArray;
}
//�m�F��ʂ̓��͓��e�o�͗p�֐�
function confirmOutput($arr){
	global $hankaku,$hankaku_array;
	$html = '';
	foreach($arr as $key => $val) {
		$out = '';
		if(is_array($val)){
			foreach($val as $key02 => $item){ 
				//�A�����ڂ̏���
				if(is_array($item)){
					$out .= connect2val($item);
				}else{
					$out .= $item . ', ';
				}
			}
			$out = rtrim($out,', ');
			
		}else{ $out = $val; }//�`�F�b�N�{�b�N�X�i�z��j�ǋL�����܂�
		if(get_magic_quotes_gpc()) { $out = stripslashes($out); }
		$out = nl2br(h($out));//���ǋL ���s�R�[�h��<br>�^�O�ɕϊ�
		$key = h($key);
		
		//�S�p�����p�ϊ�
		if($hankaku == 1){
			$out = zenkaku2hankaku($key,$out,$hankaku_array);
		}
		
		$html .= "<tr><th>".$key."</th><td>".$out;
		$html .= '<input type="hidden" name="'.$key.'" value="'.str_replace(array("<br />","<br>"),"",$out).'" />';
		$html .= "</td></tr>\n";
	}
	return $html;
}

//�S�p�����p�ϊ�
function zenkaku2hankaku($key,$out,$hankaku_array){
	global $encode;
	if(is_array($hankaku_array) && function_exists('mb_convert_kana')){
		foreach($hankaku_array as $hankaku_array_val){
			if($key == $hankaku_array_val){
				$out = mb_convert_kana($out,'a',$encode);
			}
		}
	}
	return $out;
}
//�z��A���̏���
function connect2val($arr){
	$out = '';
	foreach($arr as $key => $val){
		if($key === 0 || $val == ''){//�z�񂪖��L���i0�j�A�܂��͓��e����̂̏ꍇ�ɂ͘A��������t�����Ȃ��i�^�܂Œ��ׂ�K�v����j
			$key = '';
		}elseif(strpos($key,"�~") !== false && $val != '' && preg_match("/^[0-9]+$/",$val)){
			$val = number_format($val);//���z�̏ꍇ�ɂ�3�����ƂɃJ���}��ǉ�
		}
		$out .= $val . $key;
	}
	return $out;
}

//�Ǘ��҈����M���[���w�b�_
function adminHeader($userMail,$post_mail,$BccMail,$to){
	$header = '';
	if($userMail == 1 && !empty($post_mail)) {
		$header="From: $post_mail\n";
		if($BccMail != '') {
		  $header.="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$post_mail."\n";
	}else {
		if($BccMail != '') {
		  $header="Bcc: $BccMail\n";
		}
		$header.="Reply-To: ".$to."\n";
	}
		$header.="Content-Type:text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
		return $header;
}
//�Ǘ��҈����M���[���{�f�B
function mailToAdmin($arr,$subject,$mailFooterDsp,$mailSignature,$encode,$confirmDsp){
	$adminBody="�u".$subject."�v���烁�[�����͂��܂���\n\n";
	$adminBody .="������������������������������������������������������\n\n";
	$adminBody.= postToMail($arr);//POST�f�[�^���֐�����Z�b�g
	$adminBody.="\n������������������������������������������������������\n";
	$adminBody.="���M���ꂽ�����F".date( "Y/m/d (D) H:i:s", time() )."\n";
	$adminBody.="���M�҂�IP�A�h���X�F".@$_SERVER["REMOTE_ADDR"]."\n";
	$adminBody.="���M�҂̃z�X�g���F".getHostByAddr(getenv('REMOTE_ADDR'))."\n";
	if($confirmDsp != 1){
		$adminBody.="�₢���킹�̃y�[�WURL�F".@$_SERVER['HTTP_REFERER']."\n";
	}else{
		$adminBody.="�₢���킹�̃y�[�WURL�F".@$arr['httpReferer']."\n";
	}
	if($mailFooterDsp == 1) $adminBody.= $mailSignature;
	return mb_convert_encoding($adminBody,"JIS",$encode);
}

//���[�U�����M���[���w�b�_
function userHeader($refrom_name,$to,$encode){
	$reheader = "From: ";
	if(!empty($refrom_name)){
		$default_internal_encode = mb_internal_encoding();
		if($default_internal_encode != $encode){
			mb_internal_encoding($encode);
		}
		$reheader .= mb_encode_mimeheader($refrom_name)." <".$to.">\nReply-To: ".$to;
	}else{
		$reheader .= "$to\nReply-To: ".$to;
	}
	$reheader .= "\nContent-Type: text/plain;charset=iso-2022-jp\nX-Mailer: PHP/".phpversion();
	return $reheader;
}
//���[�U�����M���[���{�f�B
function mailToUser($arr,$dsp_name,$remail_text,$mailFooterDsp,$mailSignature,$encode){
	$userBody = '';
	if(isset($arr[$dsp_name])) $userBody = h($arr[$dsp_name]). " �l\n";
	$userBody.= $remail_text;
	$userBody.="\n������������������������������������������������������\n\n";
	$userBody.= postToMail($arr);//POST�f�[�^���֐�����Z�b�g
	$userBody.="\n������������������������������������������������������\n\n";
	$userBody.="���M�����F".date( "Y/m/d (D) H:i:s", time() )."\n";
	if($mailFooterDsp == 1) $userBody.= $mailSignature;
	return mb_convert_encoding($userBody,"JIS",$encode);
}
//�K�{�`�F�b�N�֐�
function requireCheck($require){
	$res['errm'] = '';
	$res['empty_flag'] = 0;
	foreach($require as $requireVal){
		$existsFalg = '';
		foreach($_POST as $key => $val) {
			if($key == $requireVal) {
				
				//�A���w��̍��ځi�z��j�̂��߂̕K�{�`�F�b�N
				if(is_array($val)){
					$connectEmpty = 0;
					foreach($val as $kk => $vv){
						if(is_array($vv)){
							foreach($vv as $kk02 => $vv02){
								if($vv02 == ''){
									$connectEmpty++;
								}
							}
						}
						
					}
					if($connectEmpty > 0){
						$res['errm'] .= "<p class=\"error_messe\">�y".h($key)."�z�͕K�{���ڂł��B</p>\n";
						$res['empty_flag'] = 1;
					}
				}
				//�f�t�H���g�K�{�`�F�b�N
				elseif($val == ''){
					$res['errm'] .= "<p class=\"error_messe\">�y".h($key)."�z�͕K�{���ڂł��B</p>\n";
					$res['empty_flag'] = 1;
				}
				
				$existsFalg = 1;
				break;
			}
			
		}
		if($existsFalg != 1){
				$res['errm'] .= "<p class=\"error_messe\">�y".$requireVal."�z�����I���ł��B</p>\n";
				$res['empty_flag'] = 1;
		}
	}
	
	return $res;
}
//���t�@���`�F�b�N
function refererCheck($Referer_check,$Referer_check_domain){
	if($Referer_check == 1 && !empty($Referer_check_domain)){
		if(strpos($_SERVER['HTTP_REFERER'],$Referer_check_domain) === false){
			return exit('<p align="center">���t�@���`�F�b�N�G���[�B�t�H�[���y�[�W�̃h���C���Ƃ��̃t�@�C���̃h���C������v���܂���</p>');
		}
	}
}
function copyright(){
	echo '<a style="display:block;text-align:center;margin:15px 0;font-size:11px;color:#aaa;text-decoration:none" href="http://www.php-factory.net/" target="_blank">- PHP�H�[ -</a>';
}
//----------------------------------------------------------------------
//  �֐���`(END)
//----------------------------------------------------------------------
?>
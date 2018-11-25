<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<body>
&lt;?php <br />
set_time_limit(&quot;600&quot;); <br />
//获取搜索关键字 <br />
$keyword=trim($_POST[&quot;keyword&quot;]); <br />
//检查是否为空 <br />
if($keyword==&quot;&quot;){ <br />
echo&quot;您要搜索的关键字不能为空&quot;; <br />
exit;//结束程序 <br />
} <br />
function listFiles($dir,$keyword,&amp;$array){ <br />
$handle=opendir($dir); <br />
while(false!==($file=readdir($handle))){ <br />
if($file!=&quot;.&quot;&amp;&amp;$file!=&quot;..&quot;){ <br />
if(is_dir(&quot;$dir/$file&quot;)){ <br />
listFiles(&quot;$dir/$file&quot;,$keyword,$array); <br />
} <br />
else{ <br />
$data=fread(fopen(&quot;$dir/$file&quot;,&quot;r&quot;),filesize(&quot;$dir/$file&quot;)); <br />
if(eregi(&quot;&lt;body([^&gt;]+)&gt;(.+)&lt;/body&gt;&quot;,$data,$b)){ <br />
$body=strip_tags($b[&quot;2&quot;]); <br />
} <br />
else{ <br />
$body=strip_tags($data); <br />
} <br />
if($file!=&quot;search.php&quot;){ <br />
if(eregi(&quot;$keyword&quot;,$body)){ <br />
if(eregi(&quot;&lt;title&gt;(.+)&lt;/title&gt;&quot;,$data,$m)){ <br />
$title=$m[&quot;1&quot;]; <br />
} <br />
else{ <br />
$title=&quot;没有标题&quot;; <br />
} <br />
$array[]=&quot;$dir/$file $title&quot;; <br />
} <br />
} <br />
} <br />
} <br />
} <br />
} <br />
$array=array(); <br />
listFiles(&quot;.&quot;,&quot;$keyword&quot;,$array); <br />
foreach($array as $value){ <br />
//拆开 <br />
list($filedir,$title)=split(&quot;[ ]&quot;,$value,&quot;2&quot;); <br />
//输出 <br />
echo &quot;&lt;a href=$filedir target=_blank&gt;$title &lt;/a&gt;&quot;.&quot;&lt;br&gt;/n&quot;; <br />
} <br />
?&gt; <br />
</body>

</html>

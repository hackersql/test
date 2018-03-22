命令执行函数

1).system()函数接收命令作为参数，并输出结果。
system($_GET["cmd"]);

2).exec()函数接收一个命令作为参数，但不输出结果，如果指定第二个可选参数，则结果将作为数组返回。否则，如果回显，将只显示结果的最后一行。
使用echo来输出exec()函数的结果。只显示结果的最后一行。 
echo exec('dir');
如果指定第二个参数，则在数组中返回结果。
echo exec('dir',$array);
print_r($array); 

3).shell_exec()函数类似于exec()函数，但不同的是，它会将整个结果作为字符串输出。
echo shell_exec('dir');

4).passthru()函数执行命令并返回输出。
passthru('dir');

5).preg_replace()与/e修饰符

preg_replace()函数可以执行正则表达式的搜索和替换

如果使用/e修饰符，意味着使用eval执行替换，这样我们就可以传递一个要由eval()函数执行的代码

preg_replace('/.*/e', 'system("net user");', '');

php将反引号的内容作为shell命令执行
$string=`$_GET[id]`;
echo "<pre>$string</pre>";

eval() :把字符串作为PHP代码执行

assert() :判断一个表达式是否成立，直接传入字符串会当做 PHP 代码来执行

base64() :使用base64对数据进行编码

gzdeflate() :对数据进行Deflate压缩，gzinflate()解压缩

str_rot13() :对字符串执行 ROT13 转换


文件包含函数
include($_GET['page']);
include('dvws/'.$_GET['page'].'.php');//包含文件后面不加后缀名
include('dvws/'.addslashes($_GET['page']).'.php');
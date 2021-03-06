<?php  namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\View;
class Exchangecate extends Base
{
	public function index()
	{
		if(check_login())
		{
			if(powerget())
			{
				$var_5915=input('appletid');
				$var_5916=Db::table('applet')->where('id',$var_5915)->find();
				if(!$var_5916)
				{
					$this->error('找不到对应的小程序！');
				}
				$this->assign('applet',$var_5916);
				$var_5917=Db::table('ims_sudu8_page_score_cate')->where('uniacid',$var_5915)->order('num desc')->select();
				foreach($var_5917 as $var_5918=>&$var_5919)
				{
					$var_5919['catepic']=remote($var_5915,$var_5919['catepic'],1);
				}
				$this->assign('cates',$var_5917);
			}
			else
			{
				$var_5920=Session::get('usergroup');
				if($var_5920==1)
				{
					$this->error('您没有权限操作该小程序或找不到相应小程序！','Applet/applet');
				}
				if($var_5920==2)
				{
					$this->error('您没有权限操作该小程序或找不到相应小程序！','Applet/index');
				}
				if($var_5920==3)
				{
					$this->error('您没有权限操作该小程序或找不到相应小程序！','Applet/index');
				}
			}
			return $this->fetch(index);
		}
		else
		{
			$this->redirect('Login/index');
		}
	}
	public function add()
	{
		if(check_login())
		{
			if(powerget())
			{
				$var_5922=input('appletid');
				$var_5923=Db::table('applet')->where('id',$var_5922)->find();
				if(!$var_5923)
				{
					$this->error('找不到对应的小程序！');
				}
				$this->assign('applet',$var_5923);
				$var_5924=input('cateid');
				if($var_5924)
				{
					$var_5925=Db::table('ims_sudu8_page_score_cate')->where('id',$var_5924)->find();
					if($var_5925['uniacid']==$var_5922)
					{
						$var_5925['catepic']=remote($var_5922,$var_5925['catepic'],1);
						$var_5926=$var_5925;
					}
					else
					{
						$var_5927=Session::get('usergroup');
						if($var_5927==1)
						{
							$this->error('找不到该栏目，或者该栏目不属于本小程序');
						}
						if($var_5927==2)
						{
							$this->error('找不到该栏目，或者该栏目不属于本小程序');
						}
					}
				}
				else
				{
					$var_5924=0;
					$var_5926='';
				}
				$this->assign('cateid',$var_5924);
				$this->assign('cateinfo',$var_5926);
			}
			else
			{
				$var_5927=Session::get('usergroup');
				if($var_5927==1)
				{
					$this->error('您没有权限操作该小程序或找不到相应小程序！','Applet/applet');
				}
				if($var_5927==2)
				{
					$this->error('您没有权限操作该小程序或找不到相应小程序！','Applet/index');
				}
				if($var_5927==3)
				{
					$this->error('您没有权限操作该小程序或找不到相应小程序！','Applet/index');
				}
			}
			return $this->fetch(add);
		}
		else
		{
			$this->redirect('Login/index');
		}
	}
	public function save()
	{
		$var_5929=array();
		$var_5929['uniacid']=input('appletid');
		$var_5930=input('num');
		if($var_5930)
		{
			$var_5929['num']=$var_5930;
		}
		$var_5931=input('name');
		if($var_5931)
		{
			$var_5929['name']=$var_5931;
		}
		$var_5932=input('commonuploadpic');
		if($var_5932)
		{
			$var_5929['catepic']=remote($var_5929['uniacid'],$var_5932,2);
		}
		$var_5933=input('cateid');
		if($var_5933!=0)
		{
			$var_5934=Db::table('ims_sudu8_page_score_cate')->where('id',$var_5933)->update($var_5929);
		}
		else
		{
			$var_5934=Db::table('ims_sudu8_page_score_cate')->insert($var_5929);
		}
		if($var_5934)
		{
			$this->success('栏目信息更新成功！',Url('Exchangecate/index').'?appletid='.$var_5929['uniacid']);
		}
		else
		{
			$this->error('栏目信息更新失败，没有修改项！');
			exit;
		}
	}
	public function del()
	{
		$var_5936['id']=input('cateid');
		$var_5937=Db::table('ims_sudu8_page_score_cate')->where($var_5936)->delete();
		if($var_5937)
		{
			$this->success('删除成功');
		}
		else
		{
			$this->success('删除失败');
		}
	}
	function onepic_uploade($v_1)
	{
		$var_486=request()->file($v_1);
		if(isset($var_486))
		{
			$var_5939=upload_img();
			$var_5940=$var_486->move($var_5939);
			if($var_5940)
			{
				$var_5941=ROOT_HOST.'/upimages/'.date('Ymd',time()).'/'.$var_5940->getFilename();
				return $var_5941;
			}
		}
	}
}
?>
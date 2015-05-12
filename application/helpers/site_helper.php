<?php

class SiteHelpers
{

	public static function menus( $position ='top',$active = '1')
	{
		$_this = & get_Instance();
		$data = array();  
		$menu = self::nestedMenu(0,$position ,$active);		
		foreach ($menu as $row) 
		{
			$child_level = array();
			$p = json_decode($row->access_data,true);
			
			
			if($row->allow_guest == 1)
			{
				$is_allow = 1;
			} else {
				$is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
			}
			if($is_allow ==1) 
			{
				
				$menus2 = self::nestedMenu($row->menu_id , $position ,$active );
				if(count($menus2) > 0 )
				{	 
					$level2 = array();							 
					foreach ($menus2 as $row2) 
					{
						$p = json_decode($row2->access_data,true);
						if($row2->allow_guest == 1)
						{
							$is_allow = 1;
						} else {
							$is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
						}						
									
						if($is_allow ==1)  
						{						
					
							$menu2 = array(
									'menu_id'		=> $row2->menu_id,
									'module'		=> $row2->module,
									'menu_type'		=> $row2->menu_type,
									'url'			=> $row2->url,
									'menu_name'		=> $row2->menu_name,
									'menu_icons'	=> $row2->menu_icons,
									//'menu_lang'		=> json_decode($row2->menu_lang,true),
									'childs'		=> array()
								);	
												
							$menus3 = self::nestedMenu($row2->menu_id , $position , $active);
							if(count($menus3) > 0 )
							{
								$child_level_3 = array();
								foreach ($menus3 as $row3) 
								{
									$p = json_decode($row3->access_data,true);
									if($row3->allow_guest == 1)
									{
										$is_allow = 1;
									} else {
										$is_allow = (isset($p[$_this->session->userdata('gid')]) && $p[$_this->session->userdata('gid')] ? 1 : 0);
									}										
									if($is_allow ==1)  
									{								
										$menu3 = array(
												'menu_id'		=> $row3->menu_id,
												'module'		=> $row3->module,
												'menu_type'		=> $row3->menu_type,
												'url'			=> $row3->url,												
												'menu_name'		=> $row3->menu_name,
												'menu_icons'	=> $row3->menu_icons,
											//	'menu_lang'		=> json_decode($row3->menu_lang,true),
												'childs'		=> array()
											);	
										$child_level_3[] = $menu3;	
									}					
								}
								$menu2['childs'] = $child_level_3;
							}
							$level2[] = $menu2 ;
						}	
					
					}
					$child_level = $level2;
						
				}
				
				$level = array(
						'menu_id'		=> $row->menu_id,
						'module'		=> $row->module,
						'menu_type'		=> $row->menu_type,
						'url'			=> $row->url,						
						'menu_name'		=> $row->menu_name,
						'menu_icons'	=> $row->menu_icons,
						//'menu_lang'		=> json_decode($row->menu_lang,true),
						'childs'		=> $child_level
					);			
				
				$data[] = $level;	
			}	
				
		}	
		//echo '<pre>';print_r($data); echo '</pre>'; exit;
		return $data;
	}
	
	public function nestedMenu($parent=0,$position ='top',$active = '1')
	{
		$_this = & get_Instance();
		$active 	=  ($active =='all' ? "" : "AND active ='1' ");
		$Q = $_this->db->query("
		SELECT 
			tb_menu.*
		FROM tb_menu WHERE parent_id ='". $parent ."' ".$active."  AND position ='{$position}'
		GROUP BY tb_menu.menu_id ORDER BY ordering			
		");		
		
		return $Q->result();					
	}
	
	public static function showUploadedFile($file,$path , $width = 50) {
	
		$files =  str_replace('.','',$path). $file ;		
		if(file_exists('./'.$files ) && $file !="") {
		//	echo $files ;
			$info = pathinfo($files);	
			if($info['extension'] == "jpg" || $info['extension'] == "jpeg" ||  $info['extension'] == "png" || $info['extension'] == "gif") 
			{
				$path_file = str_replace("./","",$path);
				return '<p><a href="'.site_url(''). $path_file . $file.'" target="_blank" class="previewImage">
				<img src="'.site_url(''). $path_file . $file.'" border="0" width="'. $width .'" class="img-circle" /></a></p>';
			} else {
				$path_file = site_url("./","",$path);
				return '<p> <a href="'.site_url($path_file . $file).'" target="_blank"> '.$file.' </a>';
			}
	
		} else {
			$info = pathinfo($files);
			if(isset($info['extension']))
			{
				if($info['extension'] == "jpg" || $info['extension'] == "jpeg" ||  $info['extension'] == "png" 
				|| $info['extension'] == "gif") 
				{
					$path_file = str_replace("./","",$path);
					return "<img src='".base_url('')."/uploads/images/no-image.png' border='0' width='".$width."' class='img-circle' /></a>";
				} 	
			} else {
				
			}	
		}

	}	
	
	public static function alert( $task , $message)
	{
		if($task =='error') {
			$alert ='<div class="alert alert-danger msg"><i class="fa fa-exclamation-circle"></i> '. $message.' </div>';			
		} elseif ($task =='success') {
			$alert ='<div class="alert alert-success msg"><i class="fa fa-check-circle"></i> '. $message.' </div>';		
		} elseif ($task =='warning') {
			$alert ='<div class="alert alert-warning msg"><i class="fa fa-exclamation-triangle"></i> '. $message.' </div>';
		} else {
			$alert ='<div class="alert alert-info msg"><i class="fa fa-info"></i> '. $message.' </div>';
		}
		return $alert;
	
	} 	
	
	public static function avatar( $width =75)
	{
		$_this = & get_Instance();
		$avatar = '<img alt="" src="http://www.gravatar.com/avatar/'.md5($_this->session->userdata('eid')).'" class="img-circle" width="'.$width.'" />';
		$row = $_this->db->get_where("tb_users",array('id'=>$_this->session->userdata('uid')))->row();
		$files =  './uploads/users/'.$row->avatar ;
		if($row->avatar !='' ) 	
		{
			if( file_exists($files))
			{
				return  '<img src="'.site_url().'uploads/users'.'/'.$row->avatar.'" border="0" width="'.$width.'" class="img-circle" />';
			} else {
				return $avatar;
			}	
		} else {
			return $avatar;
		}
	}		
	
	public static function CF_encode_json($arr) {
	  $str = json_encode( $arr );
	  $enc = base64_encode($str );
	  $enc = strtr( $enc, 'poligamI123456', '123456poligamI');
	  return $enc;
	}
	
	public static function CF_decode_json($str) {
	  $dec = strtr( $str , '123456poligamI', 'poligamI123456');
	  $dec = base64_decode( $dec );
	  $obj = json_decode( $dec ,true);
	  return $obj;
	}	
	
	
	public static function columnTable( $table )
	{	  
        $columns = array();
	    foreach(DB::select("SHOW COLUMNS FROM $table") as $column)
        {
           //print_r($column);
		    $columns[] = $column->Field;
        }
	  

        return $columns;
	}	
	
	public static function encryptID($id,$decript=false,$pass='',$separator='-', & $data=array()) {
		$pass = $pass ? $pass:_APP_SECNUMBER ;
		$pass2 = CNF_URL ;
		$bignum = 200000000;
		$multi1 = 500;
		$multi2 = 50;
		$saltnum = 10000000;
		if($decript==false){
			$strA = self::alphaid(($bignum+($id*$multi1)),0,0,$pass);
			$strB = self::alphaid(($saltnum+($id*$multi2)),0,0,$pass2);
			$out = $strA.$separator.$strB;
		} else {
			$pid = explode($separator,$id);
			
			
		//    trace($pid);
			$idA = (self::alphaid($pid[0],1,0,$pass)-$bignum)/$multi1;
			$idB = (self::alphaid($pid[1],1,0,$pass2)-$saltnum)/$multi2;
			$data['id A'] = $idA;
			$data['id B'] = $idB;
			$out = ($idA==$idB)?$idA:false;
		}
		return $out;
	}
	
	
	
	public static function toForm($forms,$layout)
	{
		$f = '';
		$block = $layout['column'];
		$format = $layout['format'];
		$display = $layout['display'];
		$title = explode(",",$layout['title']);
		
		if($format =='tab')
		{
			$f .='<ul class="nav nav-tabs">';
			
			for($i=0;$i<$block;$i++)
			{
				$active = ($i==0 ? 'active' : '');
				$tit = (isset($title[$i]) ? $title[$i] : 'None');	
				$f .= '<li class="'.$active.'"><a href="#'.trim(str_replace(" ","",$tit)).'" data-toggle="tab">'.$tit.'</a></li>
				';	
			}
			$f .= '</ul>';		
		}

		if($format =='tab') $f .= '<div class="tab-content">';
		for($i=0;$i<$block;$i++)
		{		
			if($block == 4) {
				$class = 'col-md-3';
			}  elseif( $block ==3 ) {
				$class = 'col-md-4';
			}  elseif( $block ==2 ) {
				$class = 'col-md-6';
			} else {
				$class = 'col-md-12';
			}	
			
			$tit = (isset($title[$i]) ? $title[$i] : 'None');	
			// Grid format 
			if($format == 'grid')
			{
				$f .= '<div class="'.$class.'">
						<fieldset><legend> '.$tit.'</legend>
				';
			} else {
				$active = ($i==0 ? 'active' : '');
				$f .= '<div class="tab-pane m-t '.$active.'" id="'.trim(str_replace(" ","",$tit)).'"> 
				';			
			}	
			
			
			
			$group = array(); 
			
			foreach($forms as $form)
			{
				$tooltip =''; $required = ($form['required'] != '0' ? '<span class="asterix"> * </span>' : '');
				if($form['view'] != 0)
				{
					if($form['field'] !='entry_by')
					{
						if(isset($form['option']['tooltip']) && $form['option']['tooltip'] !='') 	
						$tooltip = $form['option']['tooltip'];	
						$hidethis = ""; if($form['type'] =='hidden') $hidethis ='hidethis';
						$inhide = ''; if(count($group) >1) $inhide ='inhide';
						$show = '';
						if($form['type'] =='hidden') $show = 'style="display:none;"';	
						if($form['form_group'] == $i)
						{	
							if($display == 'horizontal')
							{			
								$f .= '					
								  <div class="form-group '.$hidethis.' '.$inhide.'" '.$show .'>
									<label for="'.$form['label'].'" class=" control-label col-md-4 text-left"> '.$form['label'].' '.$required.'</label>
									<div class="col-md-8">
									  '.self::formShow($form['type'],$form['field'],$form['required'],$form['option']).' <br />
									  <i> <small>'.$tooltip.'</small></i>
									 </div> 
								  </div> '; 
							} else {
								$f .= '					
								  <div class="form-group '.$hidethis.' '.$inhide.'" '.$show .'>
									<label for="ipt" class=" control-label "> '.$form['label'].'  '.$required.' '.$tooltip.' </label>									
									  '.self::formShow($form['type'],$form['field'],$form['required'],$form['option']).' 						
								  </div> '; 							
							
							}	  
						}	  
					}	  
					
				}					
			}
			if($format == 'grid') $f .='</fieldset>';
			$f .= '
			</div>
			
			';
		} 		
		return $f;
	
	}
	public static function gridClass( $layout )
	{
		$column = $layout['column'];
		$format = $layout['format'];

		if($block == 4) {
			$class = 'col-md-3';
		}  elseif( $block ==3 ) {
			$class = 'col-md-4';
		}  elseif( $block ==2 ) {
			$class = 'col-md-6';
		} else {
			$class = 'col-md-12';
		}	
				
		
		if(format == 'tab')
		{
			$tag_open = '<div class="col-md-">';
			$tag_close = '<div class="col-md-">';
			
		}  elseif($layout['format'] == 'accordion'){
		
		} else {					
			$tag_open = '<div class="col-md-">';
			$tag_close = '</div>';
		}		
		

		return $class;	
	}
	
	
	public static function formShow( $type , $field , $required ,$option = array()){
		$mandatory = '';$attribute = ''; $extend_class ='';
		if(isset($option['attribute']) && $option['attribute'] !='') {
				$attribute = $option['attribute']; }
		if(isset($option['extend_class']) && $option['extend_class'] !='') {
			$extend_class = $option['extend_class']; 
		}				
				
		$show = '';
		if($type =='hidden') $show = 'style="display:none;"';	
				
		if($required =='required') {
			$mandatory = "required";
		} else if($required =='email') {
			$mandatory = "required parsley-type='email' ";
		} else if($required =='url') {
			$mandatory = "required parsley-type='url' ";
		} else if($required =='date') {
			$mandatory = "'required parsley-type='dateIso' ";
		} else if($required =='numeric') {
			$mandatory = "required parsley-type='number' ";
		} else {
			$mandatory = '';
		}		
		
		switch($type)
		{
			default;
				$form = "<input type='text' class='form-control' placeholder='' value='<?php echo \$row['{$field}'];?>' name='{$field}'  {$mandatory} />";
				break;
				
			case 'textarea';
				if($required !='0') { $mandatory = 'required'; }
				$form = "<textarea name='{$field}' rows='2' id='{$field}' class='form-control {$extend_class}'  
				         {$mandatory} {$attribute} ><?php echo \$row['{$field}'] ;?></textarea>";
				break;

			case 'textarea_editor';
				if($required !='0') { $mandatory = 'required'; }
				$form = "<textarea name='{$field}' rows='2' id='editor' class='form-control markItUp {$extend_class}'  
						{$mandatory}{$attribute} ><?php echo \$row['{$field}'] ;?></textarea>";
				break;				
				

			case 'text_date';
				$form = "
				<input type='text' class='form-control date' placeholder='' value='<?php echo \$row['{$field}'];?>' name='{$field}'
				style='width:150px !important;'	  {$mandatory} />";
				break;
				
			case 'text_time';
				$form = "<input  type='text' name='{$field}' id='{$field}' value='{{ \$row['{$field}'] }}' 
						{$mandatory}  {$attribute} style='width:150px !important;'  class='form-control {$extend_class}'
						data-date-format='yyyy-mm-dd'
						 />";
				break;				

			case 'text_datetime';
				if($required !='0') { $mandatory = 'required'; }
				$form = "
				<input type='text' class='form-control datetime' placeholder='' value='<?php echo \$row['{$field}'];?>' name='{$field}'
				style='width:150px !important;'	  {$mandatory} />";
				break;				

			case 'select';
				if($required !='0') { $mandatory = 'required'; }
				if($option['opt_type'] =='datalist')
				{
					$optList ='';
					$opt = explode("|",$option['lookup_query']);
					for($i=0; $i<count($opt);$i++) 
					{							
						$row =  explode(":",$opt[$i]);
						for($i=0; $i<count($opt);$i++) 
						{					
							
							$row =  explode(":",$opt[$i]);
							$optList .= " '".trim($row[0])."' => '".trim($row[1])."' , ";
							
						}							
					}	
					$form  = "
					<?php \$".$field." = explode(',',\$row['".$field."']);
					";
					$form  .= 
					"\$".$field."_opt = array(".$optList."); ?>
					";	
					
					if(isset($option['is_multiple']) && $option['is_multiple'] ==1)
					{
					 
						$form  .= "<select name='{$field}[]' rows='5' {$mandatory} multiple  class='select2 '  > ";
						$form  .= "
						<?php 
						foreach(\$".$field."_opt as \$key=>\$val)
						{
							echo \"<option  value ='\$key' \".(in_array(\$key,\$".$field.") ? \" selected='selected' \" : '' ).\">\$val</option>\"; 						
						}						
						?>";
						$form .= "</select>";
					} else {
						
						$form  .= "<select name='{$field}' rows='5' {$mandatory}  class='select2 '  > ";
						$form  .= "
						<?php 
						foreach(\$".$field."_opt as \$key=>\$val)
						{
							echo \"<option  value ='\$key' \".(\$row['".$field."'] == \$key ? \" selected='selected' \" : '' ).\">\$val</option>\"; 						
						}						
						?>";
						$form .= "</select>";				
					
					}
					
				} else {
					$form = "<select name='{$field}' rows='5' id='{$field}' code='{\${$field}}' 
							class='select2 {$extend_class}'  {$mandatory} {$attribute} ></select>";
				}
				break;	
				
			case 'file'; 
				if($required !='0') { $mandatory = 'requred'; }
				$form = "<input  type='file' name='{$field}' id='{$field}' ";
				$form .= "<?php if(\$row['$field'] =='') echo 'class=\"required\"' ;?> "; 
				$form .= "style='width:150px !important;' {$attribute} />
					<?php echo SiteHelpers::showUploadedFile(\$row['{$field}'],'$option[path_to_upload]') ;?>
				";
				break;						
				
			case 'radio';
				if($required !='0') { $mandatory = 'requred'; }
				$opt = explode("|",$option['lookup_query']);
				$form = '';
				for($i=0; $i<count($opt);$i++) 
				{
					$checked = '';
					$row =  explode(":",$opt[$i]); 
					$form .= "
					<label class='radio radio-inline'>
					<input type='radio' name='{$field}' value ='".ltrim(rtrim($row[0]))."' {$mandatory} {$attribute}";
					$form .= "<?php if(\$row['".$field."'] == '".ltrim(rtrim($row[0]))."') echo 'checked=\"checked\"';?>";
					$form .= " > ".$row[1]." </label>";
				}
				break;
				
			case 'checkbox';
				if($required !='0') { $mandatory = 'requred'; }
				$opt = explode("|",$option['lookup_query']);
				$form = "<?php \$".$field." = explode(\",\",\$row['".$field."']); ?>";
				for($i=0; $i<count($opt);$i++) 
				{
					
					$checked = '';
					$row =  explode(":",$opt[$i]);					
					 $form .= "
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='{$field}[]' value ='".ltrim(rtrim($row[0]))."' {$mandatory} {$attribute} class='{$extend_class}' ";
					$form .= "
					<?php if(in_array('".trim($row[0])."',\$".$field.")) echo 'checked';?> 
					";
					$form .= " /> ".$row[1]." </label> ";					
				}
				break;				
			
		}
		
		return $form;		
	}
	
	public static function toView( $grids )
	{
		$f = '';
		foreach($grids as $grid)
		{
			if(isset($grid['conn']) && is_array($grid['conn']))
			{
				$conn = $grid['conn'];
				//print_r($conn);exit;
			} else {
				$conn = array('valid'=>0,'db'=>'','key'=>'','display'=>'');
			}
			
			if($grid['detail'] =='1')  
			{
				if($grid['attribute']['image']['active'] =='1')
				{	
					$val = "<?php echo SiteHelpers::showUploadedFile(\$row['".$grid['field']."'],'".$grid['attribute']['image']['path']."') ;?>";	
				} elseif($conn['valid'] ==1)  {
					$arr = implode(':',$conn);
					//$arg = "'".$arr['valid'].":".$arr['db'].":".$arr['key'].":".$arr['display']."'";
					$val = "<?php echo SiteHelpers::gridDisplayView(\$row['".$grid['field']."'],'".$grid['field']."','".$arr."') ;?>";
				} else {
					$val = "<?php echo \$row['".$grid['field']."'] ;?>"; 
				}
				$f .= "
					<tr>
						<td width='30%' class='label-view text-right'>".$grid['label']."</td>
						<td>".$val." </td>
						
					</tr>
				";
			}
		}
		return $f;
	}
	
	public static  function transForm( $field, $forms = array(),$bulk=false , $value ='')
	{
		$_this = & get_Instance();
		$type = ''; 
		$bulk = ($bulk == true ? '[]' : '');

		$search = $_this->input->get('search');
		if($search != '')
		{
			$fields =  explode("|",$search);
			foreach($fields as $f)
			{
				$array = explode(":",$f);
				if($array[0] ==$field) $value = $array[1];				
			}		
		}

		
		$mandatory = '';
		foreach($forms as $f)
		{
			if($f['field'] == $field && $f['search'] ==1)
			{
				$type = ($f['type'] !='file' ? $f['type'] : ''); 
				$option = $f['option'];
				$required = $f['required'];
				
				if($required =='required') {
					$mandatory = "data-parsley-required='true'";
				} else if($required =='email') {
					$mandatory = "data-parsley-type'='email' ";
				} else if($required =='date') {
					$mandatory = "data-parsley-required='true'";
				} else if($required =='numeric') {
					$mandatory = "data-parsley-type='number' ";
				} else {
					$mandatory = '';
				}				
			}	
		}
		
		switch($type)
		{
			default;
				$form ='';
				break;
			
			case 'text';			
				$form = "<input  type='text' name='".$field."{$bulk}' class='form-control input-sm' $mandatory value='{$value}'/>";
				break;

			case 'text_date';
				$form = "<input  type='text' name='$field{$bulk}' class='date form-control input-sm' $mandatory value='{$value}'/> ";
				break;

			case 'text_datetime';
				$form = "<input  type='text' name='$field{$bulk}'  class='date form-control input-sm'  $mandatory value='{$value}'/> ";
				break;				

			case 'select';
				
			
				if($option['opt_type'] =='external')
				{
					
					$data = $_this->db->get($option['lookup_table'])->result();
					$opts = '';
					foreach($data as $row):
						$selected = '';
						if($value == $row->$option['lookup_key']) $selected ='selected="selected"';
						$fields = explode("|",$option['lookup_value']);
						//print_r($fields);exit;
						$val = "";
						foreach($fields as $item=>$v)
						{
							if($v !="") $val .= $row->$v." " ;
						}
						$opts .= "<option $selected value='".$row->$option['lookup_key']."' $mandatory > ".$val." </option> ";
					endforeach;
						
				} else {
					$opt = explode("|",$option['lookup_query']);
					$opts = '';
					for($i=0; $i<count($opt);$i++) 
					{
						$selected = ''; 
						if($value == ltrim(rtrim($opt[0]))) $selected ='selected="selected"';
						$row =  explode(":",$opt[$i]); 
						$opts .= "<option $selected value ='".ltrim(rtrim($row[0]))."' > ".$row[1]." </option> ";
					}				
					
				}
				$form = "<select name='$field{$bulk}'  class='form-control' $mandatory >
							<option value=''> -- Select  -- </option>
							$opts
						</select>";
				break;	

			case 'radio';
			
				$opt = explode("|",$option['lookup_query']);
				$opts = '';
				for($i=0; $i<count($opt);$i++) 
				{
					$checked = '';
					$row =  explode(":",$opt[$i]);
					$opts .= "<option value ='".$row[0]."' > ".$row[1]." </option> ";
				}
				$form = "<select name='$field{$bulk}' class='form-control' $mandatory ><option value=''> -- Select  -- </option>$opts</select>";
				break;												
			
		}
		
		return $form;	
	}
	
	public static function viewColSpan( $grid )
	{
		$i =0;
		foreach ($grid as $t):
			if($t['view'] =='1') ++$i;
		endforeach;
		return $i;	
	}
	
	public static function blend($str,$data) {
		$src = $rep = array();
		
		foreach($data as $k=>$v){
			$src[] = "{".$k."}";
			$rep[] = $v;
		}
		
		if(is_array($str)){
			foreach($str as $st ){
				$res[] = trim(str_ireplace($src,$rep,$st));
			}
		} else {
			$res = str_ireplace($src,$rep,$str);
		}
		
		return $res;
		
	}			
		
	public static function toJavascript( $forms , $app , $class )
	{
		$f = '';
		foreach($forms as $form){
			if($form['view'] != 0)
			{			
				if(preg_match('/(select)/',$form['type'])) 
				{
					if($form['option']['opt_type'] == 'external') 
					{
						$table 	=  $form['option']['lookup_table'] ;
						$val 	=  $form['option']['lookup_value'];
						$key 	=  $form['option']['lookup_key'];
						$lookey = '';
						if($form['option']['is_dependency']) $lookey .= $form['option']['lookup_dependency_key'] ;
						$f .= self::createPreCombo( $form['field'] , $table , $key , $val ,$app, $class , $lookey  );
							
					}
									
				}
				
			}	
		
		}
		return $f;	
	
	}
	
	public static function createPreCombo( $field , $table , $key ,  $val ,$app ,$class ,$lookey = null)
	{


		
		$parent = null;
		$parent_field = null;
		if($lookey != null)  
		{	
			$parent = " parent: '#".$lookey."',";
			$parent_field =  ":{$lookey}:";
		}	
		$pre_jCombo = "
		\$(\"#{$field}\").jCombo(\"<?php echo site_url('{$class}/comboselect?filter={$table}:{$key}:{$val}') ?>$parent_field\",
		{ ".$parent." selected_value : '<?php echo \$row[\"{$field}\"] ?>' });
		";	
		return $pre_jCombo;
	}	
	
		

	public static function _sort($a, $b) {
	 
		if ($a['sortlist'] == $a['sortlist']) {
		return strnatcmp($a['sortlist'], $b['sortlist']);
		}
		return strnatcmp($a['sortlist'], $b['sortlist']);
	}

	
	static public function cropImage($nw, $nh, $source, $stype, $dest) 
	{
		$size = getimagesize($source); // ukuran gambar
		$w = $size[0];
		$h = $size[1];
		switch($stype) 
		{ // format gambar
			case 'gif':
				$simg = imagecreatefromgif($source);
				break;
			case 'jpg':
				$simg = imagecreatefromjpeg($source);
				break;
			case 'png':
				$simg = imagecreatefrompng($source);
				break;
		}
		$dimg = imagecreatetruecolor($nw, $nh); // menciptakan image baru
		$wm = $w/$nw;
		$hm = $h/$nh;
		$h_height = $nh/2;
		$w_height = $nw/2;
		if($w> $h) 
		{
			$adjusted_width = $w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
			imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
		}
		elseif(($w <$h) || ($w == $h)) 
		{
			$adjusted_height = $h / $wm;
			$half_height = $adjusted_height / 2;
			$int_height = $half_height - $h_height;
			imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
		}
		else
		{
			imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
		}
		imagejpeg($dimg,$dest,100);
	}	
		
	
	public static function gridDisplay($val , $field, $arr) {
		$_this = & get_Instance();	
		if(isset($arr['valid']) && $arr['valid'] ==1)
		{
			$fields = str_replace("|",",",$arr['display']);
			$row = $_this->db->query(" SELECT ".$fields." FROM ".$arr['db']." WHERE ".$arr['key']." = '".$val."' ")->row();
			if(count($row) >= 1 )
			{
				
				$fields = explode("|",$arr['display']);
				$v= '';
				$v .= (isset($fields[0]) && $fields[0] !='' ?  $row->$fields[0].' ' : '');
				$v .= (isset($fields[1]) && $fields[1] !=''  ? $row-> $fields[1].' ' : '');
				$v .= (isset($fields[2]) && $fields[2] !=''  ? $row->$fields[2].' ' : '');
				
				
				return $v;
			} else {
				return '';
			}
		} else {
			return $val;
		}	
	}
	public static function gridDisplayView($val , $field, $arr) {
		$arr = explode(':',$arr);
		$_this = & get_Instance();
		if(isset($arr['0']) && $arr['0'] ==1)
		{
			$row = $_this->db->query(" SELECT ".str_replace("|",",",$arr['3'])." FROM ".$arr['1']." WHERE ".$arr['2']." = '".$val."' ")->row();
			if(count($row) >= 1 )
			{
				
				$fields = explode("|",$arr['3']);
				$v= '';
				$v .= (isset($fields[0]) && $fields[0] !='' ?  $row->$fields[0].' ' : '');
				$v .= (isset($fields[1]) && $fields[1] !=''  ? $row-> $fields[1].' ' : '');
				$v .= (isset($fields[2]) && $fields[2] !=''  ? $row->$fields[2].' ' : '');
				return $v;
			} else {
				return '';
			}
		} else {
			return $val;
		}	
	}	

	public static function langOption()
	{
		$lang = scandir('application/language/');
		$t = array();
		foreach($lang as $value) {
			if($value === '.' || $value === '..') {continue;} 
				if(is_dir('application/language/' . $value))
				{
					$fp = file_get_contents('application/language/'.$value.'/info.json');
					$fp = json_decode($fp,true);
					$t[] =  $fp ;
				}	
			
		}	
		return $t;
	}		
	
	public static function themeOption()
	{
    $theme_path = base_path().'/../sximo/themes/';
		$themes = scandir( $theme_path );
		$t = array();
		foreach($themes as $value) {
			if($value === '.' || $value === '..') {continue;} 
				if(is_dir( $theme_path . $value) && file_exists( $theme_path .$value.'/info.json' ) )
				{
					$fp = file_get_contents( $theme_path .$value.'/info.json');
					$fp = json_decode($fp,true);
					$t[] =  $fp ;
				}	
			
		}	
		return $t;
	}
  

	
	public static function activeLang( $label , $l )
	{
		$activeLang = Session::get('lang');
		$lang = (isset($l[$activeLang]) ? $l[$activeLang] : $label );
		return $lang; 
		
	}

	public static function seoUrl($str, $separator = 'dash', $lowercase = FALSE)
	{
		if ($separator == 'dash')
		{
			$search		= '_';
			$replace	= '-';
		}
		else
		{
			$search		= '-';
			$replace	= '_';
		}
	
		$trans = array(
					'&\#\d+?;'				=> '',
					'&\S+?;'				=> '',
					'\s+'					=> $replace,
					'[^a-z0-9\-\._]'		=> '',
					$replace.'+'			=> $replace,
					$replace.'$'			=> $replace,
					'^'.$replace			=> $replace,
					'\.+$'					=> ''
			  );
	
		$str = strip_tags($str);
	
		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}
	
		if ($lowercase === TRUE)
		{
			$str = strtolower($str);
		}
		
		return trim(stripslashes(strtolower($str)));
	}	
	
	static public function parse_page( $str = '' ){
		
		$str = preg_replace('/\{\{#(.+)\}\}/Usi','<?php /* \1 */ ?>', $str );
		$str = preg_replace('/\{\{@(if|elseif|else|foreach|for|while)(.+)\}\}/Usi', '<?php \1 \2 : ?>', $str );
		$str = preg_replace('/\{\{@(endif|endforeach|endfor|endwhile)(.*)\}\}/Usi', '<?php \1; ?>', $str );
		$str = preg_replace('/\{\{@(.*)\}\}/Usi', '<?php \1 ?>', $str );
		$str = preg_replace('/\{\{(.*)\}\}/Usi', '<?php echo \1 ?>', $str );


			ob_start();
			$_this =& get_instance();
			extract( $_this->data );
			
			$retval = eval( "?>\n" . $str );
			
			if( $retval === false ){
				$str = highlight_string($str, true);
				$strr = explode("\n",$str);
				foreach ( $strr as $l =>& $line ){
					$line = ($l+1).'. '.$line;
				}
				$strs = implode("\n", $strr );
				echo $strs;
				exit;
			}
			
			$htm = ob_get_clean();
			return $htm;

	}
	
		
}

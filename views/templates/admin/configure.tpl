<script type="text/javascript">
$(function() {
	$("#shook [value='{$hook|escape:'html':'UTF-8'}']").attr("selected","selected");
	$("#statusChange [value='{$status|escape:'html':'UTF-8'}']").attr("selected","selected");
	$("#shareThis [value='{$shareThis|escape:'html':'UTF-8'}']").attr("checked","checked");
	$("#showefect [value='{$showEfect|escape:'html':'UTF-8'}']").attr("checked","checked");
	$("#showAfter [value='{$showOffline|escape:'html':'UTF-8'}']").attr("checked","checked");
});
</script>
<div class="panel">
	<h3><i class="icon icon-cog"></i> {l s='Change Your Status' mod='whatsapp'}</h3>
	<form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
	  <div class="form-group">
		<label for="statusChange" class="col-sm-2 control-label">{l s='Status' mod='whatsapp'}</label>
		<div class="col-sm-8">
		  <select name="statusch" id="statusChange" class="form-control">
			<option value="1">{l s='Online' mod='whatsapp'}</option>
			<option value="2">{l s='Offline' mod='whatsapp'}</option>
			<option value="3">{l s='Busy' mod='whatsapp'}</option>
		  </select>
		</div>
	  </div>
	  <div class="alert alert-info col-sm-8 col-sm-offset-2">
			&nbsp;{l s='You can use it for instant situations' mod='whatsapp'}
		</div>
		<div class="form-group">
			<label for="statusChange" class="col-sm-2 control-label clearBoth">{l s='Image' mod='whatsapp'}</label>
			<div class="col-sm-8 input-group">
				<span class="input-group-btn">
					<span class="btn btn-default btn-file">
						{l s='Browse' mod='whatsapp'} <input type="file" id="imgInp" name="avatar">
					</span>
				</span>
				<input type="text" class="form-control" readonly>
			</div>
			<div class="col-sm-8 col-sm-offset-2"> <br /> <img id="img-upload" src="{$whp_mdir|escape:'html':'UTF-8'}/views/img/whatsapp.jpg?timestamp={$timeST|escape:'html':'UTF-8'}"/></div>
		</div>
		<div class="alert alert-warning col-sm-8 col-sm-offset-2">
			&nbsp;{l s='Use Image Type Jpg, Png, Gif and size 90x90 px' mod='whatsapp'}
		</div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
		  <button type="submit" name="statusChange" class="btn btn-default ">{l s='Change Status' mod='whatsapp'}</button>
		</div>
	  </div>
	</form>
</div>
<div class="panel">
	<h3><i class="icon icon-cog"></i> {l s='Whatsapp Number' mod='whatsapp'}</h3>
	<form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
	  <div class="form-group">
		<label for="input1" class="col-sm-2 control-label">{l s='Tel' mod='whatsapp'}</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control" name="telefon" id="input1" value="{$whatasppno|escape:'html':'UTF-8'}" placeholder="{l s='905XXXX' mod='whatsapp'}">
			<br />
		</div>
		<div class="alert alert-warning col-sm-8 col-sm-offset-2">
			{if $lang_iso == 'tr'}
				&nbsp;{l s='Add contry number not add + eg TURKEY' mod='whatsapp'} : <b>90</b>5XXXX
			{else}
				&nbsp;{l s='Add contry number not add + eg USA' mod='whatsapp'} : <b>1</b>XXXXX
			{/if}
		</div>
	  </div>
	  <div class="form-group">
		<label for="userName" class="col-sm-2 control-label">{l s='Your Name' mod='whatsapp'}</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control" name="userName" id="userName" value="{$userName|escape:'html':'UTF-8'}" placeholder="{l s='Your Name' mod='whatsapp'}">
		</div>
	  </div>
	  <div class="form-group">
		<label for="shook" class="col-sm-2 control-label">{l s='Select Hook' mod='whatsapp'}</label>
		<div class="col-sm-8">
		  <select name="shook" id="shook" class="form-control">
			<option value="footer">{l s='Footer' mod='whatsapp'}</option>
			<option value="leftColumn">{l s='Left Column' mod='whatsapp'}</option>
			<option value="rightColumn">{l s='Right Column' mod='whatsapp'}</option>
		  </select>
		</div>
	  </div>
	  <div class="form-group">	
	  <label for="shareThis" class="col-sm-2 control-label">{l s='Share Product' mod='whatsapp'}</label>
		<div class="col-sm-10">
			<span id="shareThis" class="switch prestashop-switch fixed-width-lg">
				<input type="radio" name="shareThis" id="CB_on" value="1" checked="checked"/>
				<label  for="CB_on">{l s='Yes' mod='whatsapp'}</label>
				<input type="radio" name="shareThis" id="CB_off" value="0"/>
				<label  for="CB_off">{l s='No' mod='whatsapp'}</label>
				<a class="slide-button btn"></a>
			</span>
		</div>
	  </div>
	  <div class="form-group">
		<label for="shareMessage" class="col-sm-2 control-label">{l s='Message' mod='whatsapp'}</label>
		<div class="col-sm-8">
		  <textarea name="shareMessage" id="shareMessage" class="form-control" cols="30" rows="2">{$shareMessage|escape:'html':'UTF-8'}</textarea>
		  <br />
		</div>
		<div class="alert alert-info col-sm-8 col-sm-offset-2">
			&nbsp;{$pyazi|escape:'html':'UTF-8'} = {l s='Product Name' mod='whatsapp'}
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
		  <button type="submit" name="telekle" class="btn btn-default ">{l s='Save or Update' mod='whatsapp'}</button>
		</div>
	  </div>
	</form>
</div>

<div class="panel">
	<h3><i class="icon icon-cog"></i> {l s='Whatsapp Status' mod='whatsapp'}</h3>
	<form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
	  <div class="form-group">
		<label for="online" class="col-xs-12 col-sm-2 control-label">{l s='Online' mod='whatsapp'}</label>
		{foreach $languages as $l}
			<div class="translatable-field lang-{$l.id_lang|escape:'html':'UTF-8'}" {if $l.iso_code != $lang_iso}style="display:none"{/if}>
			  <div class="col-xs-9 col-sm-8">
				  <input type="text" class="form-control" name="online_{$l.id_lang|escape:'html':'UTF-8'}" value="{whatsapp::getValueLang(1, $l.id_lang)|escape:'html':'UTF-8'}" id="online_{$l.id_lang|escape:'html':'UTF-8'}" placeholder="{l s='Your Message' mod='whatsapp'}">
			  </div>
			  <div class="col-xs-3 col-sm-2">
				<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">{$l.iso_code|escape:'html':'UTF-8'} <span class="caret"></span></button>
				<ul class="dropdown-menu">
				{foreach $languages as $l}
					<li><a href="javascript:hideOtherLanguage({$l.id_lang|escape:'html':'UTF-8'});" tabindex="-1">{$l.name|escape:'html':'UTF-8'}</a></li>
				{/foreach}
				</ul>
			  </div>
			</div>
		{/foreach}
	  </div>
	  <div class="form-group">
		<label for="offline" class="col-xs-12 col-sm-2 control-label">{l s='Offline' mod='whatsapp'}</label>
		{foreach $languages as $l}
			<div class="translatable-field lang-{$l.id_lang|escape:'html':'UTF-8'}" {if $l.iso_code != $lang_iso}style="display:none"{/if}>
			  <div class="col-xs-9 col-sm-8">
				  <input type="text" class="form-control" name="offline_{$l.id_lang|escape:'html':'UTF-8'}" value="{whatsapp::getValueLang(2, $l.id_lang)|escape:'html':'UTF-8'}" id="offline_{$l.id_lang|escape:'html':'UTF-8'}" placeholder="{l s='Your Message' mod='whatsapp'}">
			  </div>
			  <div class="col-xs-3 col-sm-2">
				<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">{$l.iso_code|escape:'html':'UTF-8'} <span class="caret"></span></button>
				<ul class="dropdown-menu">
				{foreach $languages as $l}
					<li><a href="javascript:hideOtherLanguage({$l.id_lang|escape:'html':'UTF-8'});" tabindex="-1">{$l.name|escape:'html':'UTF-8'}</a></li>
				{/foreach}
				</ul>
			  </div>
			</div>
		{/foreach}
	  </div>
	  <div class="form-group">
		<label for="busy" class="col-xs-12 col-sm-2 control-label">{l s='Busy' mod='whatsapp'}</label>
		{foreach $languages as $l}
			<div class="translatable-field lang-{$l.id_lang|escape:'html':'UTF-8'}" {if $l.iso_code != $lang_iso}style="display:none"{/if}>
			  <div class="col-xs-9 col-sm-8">
				  <input type="text" class="form-control" name="busy_{$l.id_lang|escape:'html':'UTF-8'}" value="{whatsapp::getValueLang(3, $l.id_lang)|escape:'html':'UTF-8'}" id="busy_{$l.id_lang|escape:'html':'UTF-8'}" placeholder="{l s='Your Message' mod='whatsapp'}">
			  </div>
			  <div class="col-xs-3 col-sm-2">
				<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">{$l.iso_code|escape:'html':'UTF-8'} <span class="caret"></span></button>
				<ul class="dropdown-menu">
				{foreach $languages as $l}
					<li><a href="javascript:hideOtherLanguage({$l.id_lang|escape:'html':'UTF-8'});" tabindex="-1">{$l.name|escape:'html':'UTF-8'}</a></li>
				{/foreach}
				</ul>
			  </div>
			</div>
		{/foreach}
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
		  <button type="submit" name="statusEdit" class="btn btn-default ">{l s='Save or Update' mod='whatsapp'}</button>
		</div>
	  </div>
	</form>
</div>

<div class="panel">
	<h3><i class="icon icon-cog"></i> {l s='Whatsapp Setting' mod='whatsapp'}</h3>
	<form class="form-horizontal" enctype="multipart/form-data" action="" method="POST">
	  <div class="form-group">
		<label for="opn" class="col-sm-2 control-label">{l s='Working hours' mod='whatsapp'}</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control col-xs-5 col-sm-5" name="opn" id="opn" value="{$opn|escape:'html':'UTF-8'}" placeholder="8:30">
		  <input type="text" class="form-control col-xs-5 col-sm-5 pull-right" name="clse" id="clse" value="{$clse|escape:'html':'UTF-8'}" placeholder="18:30">
		</div>
	  </div>
	  <div class="alert alert-info col-sm-8 col-sm-offset-2">
		&nbsp;{l s='Your time eg: 8:30 not add 0 Use the time in 24-hour time zone' mod='whatsapp'}
	  </div>
	  <div class="alert alert-warning col-sm-8 col-sm-offset-2">
		&nbsp;{l s='Your status will be displayed online during working hours' mod='whatsapp'}
	  </div>
	  <div class="form-group clearBoth">	
	  <label for="showefect" class="col-sm-2 control-label">{l s='Show Efect' mod='whatsapp'}</label>
		<div class="col-sm-10">
			<span id="showefect" class="switch prestashop-switch fixed-width-lg">
				<input type="radio" name="showefect" id="SW_on" value="1" checked="checked"/>
				<label  for="SW_on">{l s='Yes' mod='whatsapp'}</label>
				<input type="radio" name="showefect" id="SW_off" value="0"/>
				<label  for="SW_off">{l s='No' mod='whatsapp'}</label>
				<a class="slide-button btn"></a>
			</span>
		</div>
	  </div>
	  <div class="form-group">	
	  <label for="showAfter" class="col-sm-2 control-label">{l s='Show Out Of Working Hours' mod='whatsapp'}</label>
		<div class="col-sm-10">
			<span id="showAfter" class="switch prestashop-switch fixed-width-lg">
				<input type="radio" name="showAfter" id="GS_on" value="1" checked="checked"/>
				<label  for="GS_on">{l s='Yes' mod='whatsapp'}</label>
				<input type="radio" name="showAfter" id="GS_off" value="0"/>
				<label  for="GS_off">{l s='No' mod='whatsapp'}</label>
				<a class="slide-button btn"></a>
			</span>
		</div>
	  </div>

	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
		  <button type="submit" name="globalSettings" class="btn btn-default ">{l s='Save or Update' mod='whatsapp'}</button>
		</div>
	  </div>
	</form>
</div>
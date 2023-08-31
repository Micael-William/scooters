<?php
	if ($uf==""){$uf="SP";} 
?>
<select class="form-control" name="uf" id="uf" type="text" validate="{required:true, messages:{required:'Selecione o Estado'}}"/>
<option <?php if ($uf==""){echo " selected ";}?>value="">---</option>
<option <?php if ($uf=="AC"){echo " selected ";}?>value="AC">AC </option>
<option <?php if ($uf=="AL"){echo " selected ";}?>value="AL">AL </option>
<option <?php if ($uf=="AM"){echo " selected ";}?>value="AM">AM </option>  
<option <?php if ($uf=="AP"){echo " selected ";}?>value="AP">AP </option>
<option <?php if ($uf=="BA"){echo " selected ";}?>value="BA">BA </option>
<option <?php if ($uf=="CE"){echo " selected ";}?>value="CE">CE </option>
<option <?php if ($uf=="DF"){echo " selected ";}?>value="DF">DF </option>
<option <?php if ($uf=="ES"){echo " selected ";}?>value="ES">ES </option>
<option <?php if ($uf=="GO"){echo " selected ";}?>value="GO">GO </option>
<option <?php if ($uf=="MA"){echo " selected ";}?>value="MA">MA </option>
<option <?php if ($uf=="MG"){echo " selected ";}?>value="MG">MG </option>
<option <?php if ($uf=="MS"){echo " selected ";}?>value="MS">MS </option>
<option <?php if ($uf=="MT"){echo " selected ";}?>value="MT">MT </option>
<option <?php if ($uf=="PA"){echo " selected ";}?>value="PA">PA </option>
<option <?php if ($uf=="PB"){echo " selected ";}?>value="PB">PB </option>
<option <?php if ($uf=="PE"){echo " selected ";}?>value="PE">PE </option>
<option <?php if ($uf=="PI"){echo " selected ";}?>value="PI">PI </option>
<option <?php if ($uf=="PR"){echo " selected ";}?>value="PR">PR </option>
<option <?php if ($uf=="RJ"){echo " selected ";}?>value="RJ">RJ </option>
<option <?php if ($uf=="RN"){echo " selected ";}?>value="RN">RN </option>
<option <?php if ($uf=="RO"){echo " selected ";}?>value="RO">RO </option>
<option <?php if ($uf=="RR"){echo " selected ";}?>value="RR">RR </option>
<option <?php if ($uf=="RS"){echo " selected ";}?>value="RS">RS </option>
<option <?php if ($uf=="SC"){echo " selected ";}?>value="SC">SC </option>
<option <?php if ($uf=="SE"){echo " selected ";}?>value="SE">SE </option>
<option <?php if ($uf=="SP"){echo " selected ";}?>value="SP">SP </option>
<option <?php if ($uf=="TO"){echo " selected ";}?>value="TO">TO </option>
</select>

				<form class="form-horizontal" name='formulario' id='formulario' method='post' enctype='multipart/form-data' action='<?php echo $link_pg;?>/alterar'>
				
					<?php
					
						if (strlen($cpf_cnpj)==14){ 
							$tipo="F";
							$e_cadastro="Cadastro Pessoa Física";
						}else{
							$tipo="J";
							$e_cadastro="Cadastro Pessoa Jurídica";
						
						}

						if ($nro_deptos=="" or $nro_deptos==0){$nro_deptos="3";} 

					?>
					<input type="hidden" name="cli" value="<?php echo $cli;?>">
					<input type="hidden" name="tipo" value="<?php echo $tipo;?>">
<!-- 
					<div class='row'><div class="col-md-12"><p class='bg'><b><?php echo $e_cadastro;?></b></p></div></div>
					 -->	
					<br>

					
						
					<div class='row'>
						<div class="col-md-1"></div>
						<div class="col-md-10">
						
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label text-end">Nome</div>
								<div class="col-sm-10 mb-3"><input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome;?>" validate="{required:true, messages:{required:'Favor preencher seu Nome.'}}"/></div>
							</div>


							<?php if ($tipo_sis=="E"){//e-commerce, precisa dos dados de cpf/cnpj e nro de deptos ?>
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label text-end">Cpf/Cnpj</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="cpf_cnpj" id="cpf_cnpj" value="<?php echo $cpf_cnpj;?>" onBlur="validar(this);" validate="{required:true, messages:{required:'Favor preencher seu CPF ou CNPJ. Campo oobrigatório por ser e-commerce'}}" type="text"/></div>
								<div class="col-sm-1 mb-3 col-form-label text-end"></div>


								<div class="col-sm-3 mb-3 col-form-label text-end"><a href data-toggle='tooltip' data-placement='bottom' title='Representa a quantidade de níveis de organização dos produtos. Ex: 1-Moda / 2-Acessórios / 3-Feminino / 4-Bolsas'>Nro de departamentos</a></div>
								<div class="col-sm-2 mb-3">
									<select class="form-control" name="nro_deptos" id="nro_deptos" type="text" validate="{required:true, messages:{required:'Selecione o Número de Departamentos'}}"/>
										<!-- <option <?php if ($nro_deptos=="1"){echo " selected ";}?>value="1">1</option> -->
										<option <?php if ($nro_deptos=="2"){echo " selected ";}?>value="2">2</option>
										<!-- <option <?php if ($nro_deptos=="3"){echo " selected ";}?>value="3">3</option> -->
										<option <?php if ($nro_deptos=="4"){echo " selected ";}?>value="4">4</option>  
										<!-- <option <?php if ($nro_deptos=="5"){echo " selected ";}?>value="5">5</option> -->
										<option <?php if ($nro_deptos=="6"){echo " selected ";}?>value="6">6</option>
									</select>
								</div>
							</div>
							<?php 
							}else{
								echo "<input type='hidden' name='cpf_cnpj' id='cpf_cnpj' value='".$cpf_cnpj."'>";
								echo "<input type='hidden' name='nro_deptos' id='nro_deptos' value='".$nro_deptos."'>";
							}
							?>

							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Endereço</div>
								<div class="col-sm-10 mb-3"><input class="form-control" name="endereco" id="endereco" type="text" value="<?php echo $endereco;?>"/></div>
							</div>
							
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Bairro</div>
								<div class="col-sm-6 mb-3"><input class="form-control" name="bairro" id="bairro" type="text" value="<?php echo $bairro;?>"/></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Cep</div>
								<div class="col-sm-2 mb-3"><input class="form-control cep" name="cep" id="cep" type="text" value="<?php echo $cep;?>" validate="{required:true, messages:{required:'Favor preencher o Cep'}}"/></div>
							</div>

							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Cidade</div>
								<div class="col-sm-6 mb-3"><input class="form-control" name="cidade" id="cidade" type="text" value="<?php echo $cidade;?>"></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Estado</div>
								<div class="col-sm-2 mb-3"><?php include("adm/select_uf.php");?></div>
							</div>

							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Latitude</div>
								<div class="col-sm-2 mb-3"><input class="form-control" name="latitude" id="latitude" type="text" value="<?php echo $latitude;?>"/></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Longitude</div>
								<div class="col-sm-2 mb-3"><input class="form-control" name="longitude" id="longitude" type="text" value="<?php echo $longitude;?>"/></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Zoom</div>
								<div class="col-sm-2 mb-3"><input class="form-control" name="zoom" id="zoom" type="text" value="<?php echo $zoom;?>"/></div>
							</div>
							
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Atendimento</div>
								<div class="col-sm-10 mb-3"><input class="form-control" name="atendimento" id="atendimento" type="text" value="<?php echo $atendimento;?>"/></div>
							</div>
						</div><!-- 10 -->
						<div class="col-md-1 mb-3"></div>
					</div>
					<div class='row'><div class="col-md-12 mb-3"><hr></div></div>

					<div class='row'>
						<div class="col-md-1 mb-3"></div>
						<div class="col-md-10 mb-3">
						
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Email</div>
								<div class="col-sm-10 mb-3"><input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" validate="{required:true, email:true, messages:{required:'O Email &eacute; obrigat&oacute;rio.', email:'Forne&ccedil;a um email v&aacute;lido'}}"/></div>
							</div>
						
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Telefone(s)</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="telefone" id="telefone" type="text" value="<?php echo $telefone;?>"></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">WhatsApp</div>
								<div class="col-sm-4 mb-3"><input class="form-control cel" name="whats" id="whats" type="text" value="<?php echo $whats;?>"></div>
							</div>
							
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Facebook</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="facebook" id="facebook" type="text" value="<?php echo $facebook;?>"></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Twitter</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="twitter" id="twitter" type="text" value="<?php echo $twitter;?>"></div>
							</div>

							<div class="row">
								
								<div class="col-sm-2 mb-3 col-form-label  text-end">Canal Youtube</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="youtube" id="youtube" type="text" value="<?php echo $youtube;?>"></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Google Plus</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="g_plus" id="g_plus" type="text" value="<?php echo $g_plus;?>"></div>
							</div>

							<div class="row">
								
								<div class="col-sm-2 mb-3 col-form-label  text-end">Tripadvisor</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="tripadvisor" id="tripadvisor" type="text" value="<?php echo $tripadvisor;?>"></div>
								<div class="col-sm-2 mb-3 col-form-label  text-end">Instagram</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="instagram" id="instagram" type="text" value="<?php echo $instagram;?>"></div>
							</div>

							<!-- <div class="form-group">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Pinterest</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="pinterest" id="pinterest" type="text" value="<?php echo $pinterest;?>"></div>
							</div> -->

						</div><!-- 10 -->
						<div class="col-md-1 mb-3"></div>
					</div>

					<br>
					<div class='row'><div class="col-md-12 mb-3"><p class='bg text-end'><b>Dados de conexão</b>&nbsp;&nbsp;&nbsp;</p></div></div>
					<br>
						
					<div class='row'>
						<div class="col-md-1 mb-3"></div>
						<div class="col-md-10 mb-3">
							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Email</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="ea" id="ea" type="text" value="<?php echo $ea;?>"></div>
								<div class="col-md-6 mb-3">* email usado para autenticação de envio dos formulários</div>
							</div>

							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Senha</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="sa" id="sa" type="password" value="<?php echo $sa;?>"></div>
								<div class="col-md-6 mb-3">* senha do email de autenticação</div>
							</div>

							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Servidor</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="sv" id="sv" type="text" value="<?php echo $sv;?>"></div>
								<div class="col-md-6 mb-3">* Servidor SMTP</div>
							</div>

							<div class="row">
								<div class="col-sm-2 mb-3 col-form-label  text-end">Url Base</div>
								<div class="col-sm-4 mb-3"><input class="form-control" name="xurl_site" id="xurl_site" type="text" value="<?php echo $url_site;?>" disabled></div>
								<div class="col-md-6 mb-3"><input class="form-control" name="url_site" id="url_site" type="hidden" value="<?php echo $url_site;?>"></div>
							</div>

						</div><!-- 10 -->
						<div class="col-md-1 mb-3"></div>
					</div><!-- row -->


					<div class='row'>
						<div class='col-sm-12 mb-3'>
							<p class='bg text-end'>&nbsp;&nbsp;<b>Otimização SEO - Padrão</b>&nbsp;<input type='checkbox' name="mostra_meta" value='0' onclick="mostra_div('mostra_meta');"></p>
						</div>
					</div>

					<div class='row' id='mostra_meta' style='display:none;'>
						<div class="col-md-1 mb-3"></div>
						<div class='col-sm-10 mb-3'>
							<div class='row'>
								<div class='col-sm-2 mb-3 col-form-label  text-end'>Título</div>
								<div class='col-sm-10 mb-3'><input type='text' class='form-control' name='title' id='title' value='<?php echo $title;?>'></div>
							</div>
							<div class='row'>
								<div class='col-sm-2 mb-3 col-form-label  text-end'>Descrição</div>
								<div class='col-sm-10 mb-3'><textarea class='form-control' name='description' id='description' wrap='virtual' style='height:60px;'><?php echo $description;?></textarea></div>
							</div>
							<div class='row'>
								<div class='col-sm-2 mb-3 col-form-label  text-end'>Palavras Chave</div>
								<div class='col-sm-10 mb-3'><textarea class='form-control' name='keywords' id='keywords' wrap='virtual' style='height:60px;'><?php echo $keywords;?></textarea></div>
							</div>
						</div>
						<div class="col-md-1 mb-3"></div>
					</div>

					<div class='row'>
						<div class='col-sm-12 mb-3'>
							<p class='bg text-end'>&nbsp;&nbsp;<b>Script tag</b>&nbsp;<input type='checkbox' name="mostra_script" value='0' onclick="mostra_div('mostra_script');"></p>
						</div>
					</div>

					<div class='row' id='mostra_script' style='display:none;'>
						<div class="col-md-1 mb-3"></div>
						<div class='col-sm-10 mb-3'>
							<div class='row'>
								<div class='col-sm-2 mb-3 col-form-label  text-end'>Meta Head</div>
								<div class='col-sm-10 mb-3'><textarea class='form-control' name='tag_head' id='tag_head' wrap='virtual' style='height:80px;'><?php echo $tag_head;?></textarea></div>
							</div>
							<div class='row'>
								<div class='col-sm-2 mb-3 col-form-label  text-end'>JavaScript</div>
								<div class='col-sm-10 mb-3'><textarea class='form-control' name='tag_script' id='tag_script' wrap='virtual' style='height:80px;'><?php echo $tag_script;?></textarea></div>
							</div>
						</div>
						<div class="col-md-1 mb-3"></div>
					</div>
					
					<div class="error mb-3"></div>

					<p class='text-end mb-3'><button type='submit' name='cadastra' id='cadastra' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button></p>
				</form>
	
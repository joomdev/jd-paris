<?php
defined('_JEXEC') or die;
$services = $params->get('services', []);
 
// $LinkOn = $params->get('LinkOn');
$showReadMore = $params->get('showReadMore');
$showReadMoreText = $params->get('showReadMoreText');
$showReadMoreIcon = $params->get('showReadMoreIcon');
$button_link = $params->get('button_link');
$modJDServicesShowcaseHelper = new modJDServicesShowcaseHelper();
?>
		<section class="jd-services-showcase">
			<div>
				<div class="jd-row">
				<?php foreach ($services as $service) {  $items = $modJDServicesShowcaseHelper->get_post($service->article_id,'DESC','id'); $images = json_decode($items['images']);  ?>
						<?php if($service->switch=='2') {  ?>
							<div class="jd-col-lg-4 jd-col-md-6 jd-col-sm-12 d-md-flex">
								<div class="service-box">
									<div class="service-box-inner">
										<div class="image-overlay">
											<a href="<?php echo $url = JRoute::_('index.php?Itemid=' . $service->link); ?>">
												<div class="image">
													<img src="<?php echo $service->serveices_icon_upload; ?>" alt="img"/>
												</div>
												<div class="overlay">
													<?php if(!empty($service->serveices_hover_img)) { ?>
														<div class="image">
															<img src="<?php echo $service->serveices_hover_img; ?>" alt="overlay-img"/>
														</div>
													<?php  } ?>
												</div>
											</a>
										</div>
										<div class="content">
											
											<?php if(!empty($service->title)){ ?>
												<div class="title">
													<a href="<?php echo $url = JRoute::_('index.php?Itemid=' . $service->link); ?>"><?php echo $service->title; ?></a>
												</div>
											<?php }  ?>

											<?php if(!empty($service->subtitle)){ ?>
												<div class="sub-title">
													<?php echo $service->subtitle; ?>
												</div>
											<?php }  ?>

											<?php if(!empty($service->description)){ ?>
												<div class="description">
													<?php echo $service->description; ?>
												</div>
											<?php }  ?>

											<?php if(($showReadMore=="1")){ ?>
												<div class="read-more">
													<?php if(!empty($showReadMoreText)){ ?>
														<a href="<?php echo $url = JRoute::_('index.php?Itemid=' . $service->link); ?>">
															<p class="mb-0 read-more">
																<?php echo $showReadMoreText; ?>
															</p>
														</a>
													<?php } ?>
												</div>											
											<?php } ?>

											<?php if(($showReadMore=="2")){ ?>
												<div class="read-more">
													<?php if(!empty($showReadMoreIcon)){ ?>
														<a href="<?php echo $url = JRoute::_('index.php?Itemid=' . $service->link); ?>">
															<p class="mb-0 read-more"><i class="<?php echo $showReadMoreIcon;  ?>"></i></p>
														</a>
													<?php } ?>
												</div>	
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php  }   ?>

						<?php if($service->switch=='1') {  ?>
							<div class="jd-col-lg-4 jd-col-md-6 jd-col-sm-12 d-md-flex">
								<div class="service-box">
									<div class="service-box-inner">
										<div class="image-overlay">
											<a href="<?php echo $items['link']; ?>">
												<?php if(!empty($images->image_intro)) { ?>
													<div class="image">
														<img src="<?php echo $images->image_intro; ?>" alt="img"/>
													</div>
												<?php }  ?>

												<div class="overlay">
													<?php if(!empty($service->serveices_hover_img)) { ?>
														<div class="image">
															<img src="<?php echo $service->serveices_hover_img; ?>" alt="overlay-img"/>
														</div>
													<?php  } ?>
												</div>
											</a>
										</div>
										<div class="content">
											
											<?php if(!empty($items['title'])){ ?>
												<div class="title">
													<a href="<?php echo $items['link']; ?>"><?php echo $items['title']; ?></a>
												</div>
											<?php }  ?>

											<?php if(!empty($service->subtitle)){ ?>
												<div class="sub-title">
													<?php echo $service->subtitle; ?>
												</div>
											<?php }  ?>

											<?php if(!empty($items['intro'])){ ?>
												<div class="description">
													<?php echo $items['intro']; ?>
												</div>
											<?php }  ?>

											<?php if(($showReadMore=="1")){ ?>
												<div class="read-more">
													<?php if(!empty($showReadMoreText)){ ?>
														<a href="<?php echo $items['link']; ?>">
															<p class="mb-0">
																<?php echo $showReadMoreText; ?>
															</p>
														</a>
													<?php } ?>
												</div>											
											<?php } ?>

											<?php if(($showReadMore=="2")){ ?>
												<?php if(!empty($showReadMoreIcon)){ ?>
													<a href="<?php echo $items['link']; ?>">
														<p class="mb-0 read-more"><i class="<?php echo $showReadMoreIcon;  ?>"></i></p>
													</a>
												<?php } ?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php  }   ?>
					<?php } ?>	
				</div>
				<?php if($params->get('showReadMoreInner', 0)) { ?>
					<div class="row pt-4">
						<div class="col-12 d-flex justify-content-center">	
							<a href="<?php echo JRoute::_("index.php?Itemid={$button_link}"); ?>"><button class="btn btn-lg btn-primary"><?php echo $params->get('button','See More'); ?></button></a>
						</div>
					</div>
				<?php }  ?>
			</div>
		</section>
<?php
namespace FourZero\LightDarkMode;
if(!defined('ABSPATH'))exit;
class Elementor_Widget extends \Elementor\Widget_Base{
 public function get_name(){return 'fourzero_light_dark_mode';}
 public function get_title(){return 'FourZero Light & Dark Mode';}
 public function get_icon(){return 'eicon-adjust';}
 public function get_categories(){return ['general'];}
 public function get_keywords(){return ['dark mode','light mode','theme','toggle','fourzero'];}
 protected function register_controls(){
  $this->start_controls_section('content',['label'=>'Toggle Switch','tab'=>\Elementor\Controls_Manager::TAB_CONTENT]);
  $this->add_control('show_labels',['label'=>'Show labels','type'=>\Elementor\Controls_Manager::SWITCHER,'return_value'=>'yes','default'=>'no']);
  $this->add_control('light_label',['label'=>'Light label','type'=>\Elementor\Controls_Manager::TEXT,'default'=>'Light','condition'=>['show_labels'=>'yes']]);
  $this->add_control('dark_label',['label'=>'Dark label','type'=>\Elementor\Controls_Manager::TEXT,'default'=>'Dark','condition'=>['show_labels'=>'yes']]);
  $this->end_controls_section();
  $this->start_controls_section('style',['label'=>'Toggle Style','tab'=>\Elementor\Controls_Manager::TAB_STYLE]);
  $this->add_control('track_color',['label'=>'Light track','type'=>\Elementor\Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .fz-toggle'=>'background-color:{{VALUE}};']]);
  $this->add_control('dark_track_color',['label'=>'Dark track','type'=>\Elementor\Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .fz-toggle'=>'--fz-dark-track:{{VALUE}};']]);
  $this->add_control('thumb_color',['label'=>'Switch thumb','type'=>\Elementor\Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .fz-toggle__thumb'=>'background-color:{{VALUE}};']]);
  $this->add_responsive_control('width',['label'=>'Width','type'=>\Elementor\Controls_Manager::SLIDER,'size_units'=>['px'],'range'=>['px'=>['min'=>32,'max'=>100]],'default'=>['unit'=>'px','size'=>54],'selectors'=>['{{WRAPPER}} .fz-toggle'=>'width:{{SIZE}}{{UNIT}};']]);
  $this->add_responsive_control('height',['label'=>'Height','type'=>\Elementor\Controls_Manager::SLIDER,'size_units'=>['px'],'range'=>['px'=>['min'=>20,'max'=>60]],'default'=>['unit'=>'px','size'=>30],'selectors'=>['{{WRAPPER}} .fz-toggle'=>'height:{{SIZE}}{{UNIT}};']]);
  $this->add_responsive_control('thumb_size',['label'=>'Thumb size','type'=>\Elementor\Controls_Manager::SLIDER,'size_units'=>['px'],'range'=>['px'=>['min'=>12,'max'=>50]],'default'=>['unit'=>'px','size'=>22],'selectors'=>['{{WRAPPER}} .fz-toggle__thumb'=>'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};']]);
  $this->add_responsive_control('radius',['label'=>'Track radius','type'=>\Elementor\Controls_Manager::SLIDER,'size_units'=>['px'],'range'=>['px'=>['min'=>0,'max'=>50]],'default'=>['unit'=>'px','size'=>20],'selectors'=>['{{WRAPPER}} .fz-toggle'=>'border-radius:{{SIZE}}{{UNIT}};']]);
  $this->end_controls_section();
 }
 protected function render(){ $s=$this->get_settings_for_display(); $labels=($s['show_labels']??'')==='yes'; ?>
 <div class="fz-ldm-widget fz-ldm-toggle-wrap" role="group" aria-label="Colour mode">
 <?php if($labels): ?><span class="fz-toggle-label fz-toggle-label--light"><?php echo esc_html($s['light_label']); ?></span><?php endif; ?>
 <button type="button" class="fz-toggle" data-fz-toggle aria-label="Toggle dark mode" aria-pressed="false"><span class="fz-toggle__thumb"></span></button>
 <?php if($labels): ?><span class="fz-toggle-label fz-toggle-label--dark"><?php echo esc_html($s['dark_label']); ?></span><?php endif; ?>
 </div>
 <?php }
}

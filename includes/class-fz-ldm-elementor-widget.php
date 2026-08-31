<?php
namespace FourZero\LightDarkMode;
if(!defined('ABSPATH'))exit;
class Elementor_Widget extends \Elementor\Widget_Base{
 public function get_name(){return 'fourzero_light_dark_mode';}
 public function get_title(){return 'FourZero Light & Dark Mode';}
 public function get_icon(){return 'eicon-adjust';}
 public function get_categories(){return ['general'];}
 public function get_keywords(){return ['dark mode','light mode','theme','fourzero'];}
 protected function register_controls(){
  $this->start_controls_section('content',['label'=>'Mode Switcher','tab'=>\Elementor\Controls_Manager::TAB_CONTENT]);
  $this->add_control('style_type',['label'=>'Style','type'=>\Elementor\Controls_Manager::SELECT,'default'=>'pill','options'=>['pill'=>'Pill','compact'=>'Compact','switch'=>'Switch']]);
  $this->add_control('show_system',['label'=>'Show System option','type'=>\Elementor\Controls_Manager::SWITCHER,'return_value'=>'yes','default'=>'yes']);
  $this->add_control('show_labels',['label'=>'Show labels','type'=>\Elementor\Controls_Manager::SWITCHER,'return_value'=>'yes','default'=>'yes']);
  $this->add_control('light_label',['label'=>'Light label','type'=>\Elementor\Controls_Manager::TEXT,'default'=>'☀ Light']);
  $this->add_control('dark_label',['label'=>'Dark label','type'=>\Elementor\Controls_Manager::TEXT,'default'=>'🌙 Dark']);
  $this->add_control('system_label',['label'=>'System label','type'=>\Elementor\Controls_Manager::TEXT,'default'=>'◐ System']);
  $this->end_controls_section();
  $this->start_controls_section('style',['label'=>'Button Style','tab'=>\Elementor\Controls_Manager::TAB_STYLE]);
  $this->add_control('text_color',['label'=>'Text','type'=>\Elementor\Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .fz-ldm-widget button'=>'color: {{VALUE}};']]);
  $this->add_control('background',['label'=>'Background','type'=>\Elementor\Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .fz-ldm-widget button'=>'background-color: {{VALUE}};']]);
  $this->add_control('border_color',['label'=>'Border','type'=>\Elementor\Controls_Manager::COLOR,'selectors'=>['{{WRAPPER}} .fz-ldm-widget button'=>'border-color: {{VALUE}};']]);
  $this->add_responsive_control('radius',['label'=>'Border radius','type'=>\Elementor\Controls_Manager::SLIDER,'size_units'=>['px','%'],'range'=>['px'=>['min'=>0,'max'=>50],'%'=>['min'=>0,'max'=>50]],'selectors'=>['{{WRAPPER}} .fz-ldm-widget button'=>'border-radius: {{SIZE}}{{UNIT}};']]);
  $this->end_controls_section();
 }
 protected function render(){ $s=$this->get_settings_for_display();$style=esc_attr($s['style_type']);$show=($s['show_labels']??'')==='yes';$system=($s['show_system']??'')==='yes';$labels=['light'=>$show?$s['light_label']:'☀','dark'=>$show?$s['dark_label']:'🌙','system'=>$show?$s['system_label']:'◐';?>
 <div class="fz-ldm-widget fz-ldm-widget--<?php echo $style;?>" role="group" aria-label="Colour mode"><div class="fz-ldm-widget__group"><?php foreach(['light','dark'] as $mode):?><button type="button" data-fz-mode-value="<?php echo esc_attr($mode);?>" aria-pressed="false"><?php echo esc_html($labels[$mode]);?></button><?php endforeach;if($system):?><button type="button" data-fz-mode-value="system" aria-pressed="false"><?php echo esc_html($labels['system']);?></button><?php endif;?></div></div>
 <?php }
}

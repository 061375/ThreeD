<?php
require_once('php/an8.2.0.1.class.php');
define("MAX_BYTES",1000000);
$points = 0;
$faces = 0;
$action = isset($_POST['action']) ? $_POST['action'] : false;
$displayModel = false;
$an8 = new An8();
if ("upload_an8" == $action) {
    $result = $an8->uploadAn8();
    if (false === $result)
		$an8->display_errors();
		$data = $an8->openAn8($result['file']);
		if (false === $data)
			$an8->display_errors();
			$result = $an8->prepareAn8($data);
			if (false === $result)
				$an8->display_errors();
				$points = $an8->get3Dpoints($result);
				if(false === $points)
					$an8->display_errors();
					$points = $an8->make3Dpoints($points);
					if(false === $points)
						$an8->display_errors();
						$faces = $an8->get3Dfaces($result);
						$faces = $an8->make3Dfaces($faces);
						$displayModel = true;
}
?>
<!doctype html>

<html lang="en">
<head>
    <title>Wes Mantooth - Import Anim8or 3D Model</title>
	<script src="js/wes.mantooth.js"></script>
    <script>
        const   W = 800,
                H = 800
        window.onload = function() {

            'use strict';
            
            $w.gamespeed = 80;
            
			let i = $w.add_object_single (
				1,
				Cube,{
					w:W,
					h:H
				},
				document.getElementById('target'),
				W,H
			);
			
			$w.loop(true,i);
        }
        /**
         * Cube
         * 
         * @param {Object}
         * @returns {Void}
         * */
        var Cube = function(o){
            this.i = o.i
            this.focalLength = W;
            this.zOrigin = 10;
            <?php if (false !== $displayModel) { ?>
            <?php echo $points; ?>
            <?php echo $faces; ?>
			<?php } else{ ?>
			// If no model uploaded the tetra is shown by default
			this.pointsArray = [
					this.make3DPoint(7.8562,2.1,2.4883),
					this.make3DPoint(6.6562,1.9,2.4883),
					this.make3DPoint(6.5403,2.3447,2.4883),
					this.make3DPoint(6.3924,2.7227,2.4883),
					this.make3DPoint(6.2125,3.0338,2.4883),
					this.make3DPoint(6.0008,3.2781,2.4883),
					this.make3DPoint(5.8072,3.43,2.4883),
					this.make3DPoint(5.5908,3.5481,2.4883),
					this.make3DPoint(5.3516,3.6325,2.4883),
					this.make3DPoint(5.0895,3.6831,2.4883),
					this.make3DPoint(4.8047,3.7,2.4883),
					this.make3DPoint(4.4703,3.6784,2.4883),
					this.make3DPoint(4.1623,3.6137,2.4883),
					this.make3DPoint(3.8806,3.5059,2.4883),
					this.make3DPoint(3.6252,3.355,2.4883),
					this.make3DPoint(3.3961,3.1609,2.4883),
					this.make3DPoint(3.2017,2.935,2.4883),
					this.make3DPoint(3.0506,2.6884,2.4883),
					this.make3DPoint(2.9426,2.4212,2.4883),
					this.make3DPoint(2.8778,2.1334,2.4883),
					this.make3DPoint(2.8562,1.825,2.4883),
					this.make3DPoint(2.8772,1.5312,2.4883),
					this.make3DPoint(2.9399,1.2584,2.4883),
					this.make3DPoint(3.0444,1.0067,2.4883),
					this.make3DPoint(3.1907,0.776,2.4883),
					this.make3DPoint(3.3789,0.5664,2.4883),
					this.make3DPoint(3.5993,0.38725,2.4883),
					this.make3DPoint(3.8424,0.24791,2.4883),
					this.make3DPoint(4.1082,0.14837,2.4883),
					this.make3DPoint(4.3967,0.08865,2.4883),
					this.make3DPoint(4.7078,0.06875,2.4883),
					this.make3DPoint(5.0773,0.10156,2.4883),
					this.make3DPoint(5.5266,0.2,2.4883),
					this.make3DPoint(5.3984,-0.9,2.4883),
					this.make3DPoint(5.2141,-0.8875,2.4883),
					this.make3DPoint(4.8659,-0.90977,2.4883),
					this.make3DPoint(4.5355,-0.97656,2.4883),
					this.make3DPoint(4.2229,-1.0879,2.4883),
					this.make3DPoint(3.9281,-1.2438,2.4883),
					this.make3DPoint(3.7534,-1.3732,2.4883),
					this.make3DPoint(3.6104,-1.5241,2.4883),
					this.make3DPoint(3.4992,-1.6965,2.4883),
					this.make3DPoint(3.4198,-1.8903,2.4883),
					this.make3DPoint(3.3721,-2.1055,2.4883),
					this.make3DPoint(3.3562,-2.3422,2.4883),
					this.make3DPoint(3.3732,-2.5686,2.4883),
					this.make3DPoint(3.4241,-2.7789,2.4883),
					this.make3DPoint(3.509,-2.9733,2.4883),
					this.make3DPoint(3.6277,-3.1517,2.4883),
					this.make3DPoint(3.7805,-3.3141,2.4883),
					this.make3DPoint(3.9601,-3.453,2.4883),
					this.make3DPoint(4.1595,-3.5611,2.4883),
					this.make3DPoint(4.3787,-3.6382,2.4883),
					this.make3DPoint(4.6177,-3.6846,2.4883),
					this.make3DPoint(4.8766,-3.7,2.4883),
					this.make3DPoint(5.1339,-3.684,2.4883),
					this.make3DPoint(5.3736,-3.636,2.4883),
					this.make3DPoint(5.5954,-3.556,2.4883),
					this.make3DPoint(5.7996,-3.444,2.4883),
					this.make3DPoint(5.9859,-3.3,2.4883),
					this.make3DPoint(6.188,-3.075,2.4883),
					this.make3DPoint(6.3504,-2.8,2.4883),
					this.make3DPoint(6.4731,-2.475,2.4883),
					this.make3DPoint(6.5562,-2.1,2.4883),
					this.make3DPoint(7.7562,-2.3,2.4883),
					this.make3DPoint(7.6162,-2.8618,2.4883),
					this.make3DPoint(7.4086,-3.3566,2.4883),
					this.make3DPoint(7.1334,-3.7845,2.4883),
					this.make3DPoint(6.7906,-4.1453,2.4883),
					this.make3DPoint(6.4747,-4.381,2.4883),
					this.make3DPoint(6.1294,-4.5643,2.4883),
					this.make3DPoint(5.7547,-4.6952,2.4883),
					this.make3DPoint(5.3506,-4.7738,2.4883),
					this.make3DPoint(4.9172,-4.8,2.4883),
					this.make3DPoint(4.4161,-4.7637,2.4883),
					this.make3DPoint(3.9422,-4.6549,2.4883),
					this.make3DPoint(3.4953,-4.4734,2.4883),
					this.make3DPoint(3.1894,-4.2953,2.4883),
					this.make3DPoint(2.9217,-4.0873,2.4883),
					this.make3DPoint(2.6921,-3.8496,2.4883),
					this.make3DPoint(2.5008,-3.582,2.4883),
					this.make3DPoint(2.35,-3.2952,2.4883),
					this.make3DPoint(2.2424,-2.9994,2.4883),
					this.make3DPoint(2.1778,-2.6948,2.4883),
					this.make3DPoint(2.1562,-2.3813,2.4883),
					this.make3DPoint(2.177,-2.0871,2.4883),
					this.make3DPoint(2.2391,-1.8063,2.4883),
					this.make3DPoint(2.3426,-1.5387,2.4883),
					this.make3DPoint(2.4875,-1.2844,2.4883),
					this.make3DPoint(2.6729,-1.0494,2.4883),
					this.make3DPoint(2.898,-0.83984,2.4883),
					this.make3DPoint(3.1628,-0.65567,2.4883),
					this.make3DPoint(3.4672,-0.49688,2.4883),
					this.make3DPoint(3.0678,-0.37398,2.4883),
					this.make3DPoint(2.7135,-0.19902,2.4883),
					this.make3DPoint(2.4041,0.02798,2.4883),
					this.make3DPoint(2.1398,0.30703,2.4883),
					this.make3DPoint(1.9283,0.6313,2.4883),
					this.make3DPoint(1.7771,0.99394,2.4883),
					this.make3DPoint(1.6865,1.395,2.4883),
					this.make3DPoint(1.6562,1.8344,2.4883),
					this.make3DPoint(1.6924,2.3155,2.4883),
					this.make3DPoint(1.8009,2.7664,2.4883),
					this.make3DPoint(1.9817,3.187,2.4883),
					this.make3DPoint(2.2347,3.5774,2.4883),
					this.make3DPoint(2.5602,3.9375,2.4883),
					this.make3DPoint(2.9409,4.248,2.4883),
					this.make3DPoint(3.3599,4.4895,2.4883),
					this.make3DPoint(3.8172,4.662,2.4883),
					this.make3DPoint(4.3129,4.7655,2.4883),
					this.make3DPoint(4.8469,4.8,2.4883),
					this.make3DPoint(5.3287,4.7699,2.4883),
					this.make3DPoint(5.7766,4.6797,2.4883),
					this.make3DPoint(6.1907,4.5294,2.4883),
					this.make3DPoint(6.5709,4.319,2.4883),
					this.make3DPoint(6.9172,4.0484,2.4883),
					this.make3DPoint(7.2182,3.73,2.4883),
					this.make3DPoint(7.4627,3.3759,2.4883),
					this.make3DPoint(7.6505,2.9862,2.4883),
					this.make3DPoint(7.7817,2.5609,2.4883),
					this.make3DPoint(7.8562,2.1,-2.5117),
					this.make3DPoint(6.6562,1.9,-2.5117),
					this.make3DPoint(6.5403,2.3447,-2.5117),
					this.make3DPoint(6.3924,2.7227,-2.5117),
					this.make3DPoint(6.2125,3.0338,-2.5117),
					this.make3DPoint(6.0008,3.2781,-2.5117),
					this.make3DPoint(5.8072,3.43,-2.5117),
					this.make3DPoint(5.5908,3.5481,-2.5117),
					this.make3DPoint(5.3516,3.6325,-2.5117),
					this.make3DPoint(5.0895,3.6831,-2.5117),
					this.make3DPoint(4.8047,3.7,-2.5117),
					this.make3DPoint(4.4703,3.6784,-2.5117),
					this.make3DPoint(4.1623,3.6137,-2.5117),
					this.make3DPoint(3.8806,3.5059,-2.5117),
					this.make3DPoint(3.6252,3.355,-2.5117),
					this.make3DPoint(3.3961,3.1609,-2.5117),
					this.make3DPoint(3.2017,2.935,-2.5117),
					this.make3DPoint(3.0506,2.6884,-2.5117),
					this.make3DPoint(2.9426,2.4212,-2.5117),
					this.make3DPoint(2.8778,2.1334,-2.5117),
					this.make3DPoint(2.8562,1.825,-2.5117),
					this.make3DPoint(2.8772,1.5312,-2.5117),
					this.make3DPoint(2.9399,1.2584,-2.5117),
					this.make3DPoint(3.0444,1.0067,-2.5117),
					this.make3DPoint(3.1907,0.776,-2.5117),
					this.make3DPoint(3.3789,0.5664,-2.5117),
					this.make3DPoint(3.5993,0.38725,-2.5117),
					this.make3DPoint(3.8424,0.24791,-2.5117),
					this.make3DPoint(4.1082,0.14837,-2.5117),
					this.make3DPoint(4.3967,0.08865,-2.5117),
					this.make3DPoint(4.7078,0.06875,-2.5117),
					this.make3DPoint(5.0773,0.10156,-2.5117),
					this.make3DPoint(5.5266,0.2,-2.5117),
					this.make3DPoint(5.3984,-0.9,-2.5117),
					this.make3DPoint(5.2141,-0.8875,-2.5117),
					this.make3DPoint(4.8659,-0.90977,-2.5117),
					this.make3DPoint(4.5355,-0.97656,-2.5117),
					this.make3DPoint(4.2229,-1.0879,-2.5117),
					this.make3DPoint(3.9281,-1.2438,-2.5117),
					this.make3DPoint(3.7534,-1.3732,-2.5117),
					this.make3DPoint(3.6104,-1.5241,-2.5117),
					this.make3DPoint(3.4992,-1.6965,-2.5117),
					this.make3DPoint(3.4198,-1.8903,-2.5117),
					this.make3DPoint(3.3721,-2.1055,-2.5117),
					this.make3DPoint(3.3562,-2.3422,-2.5117),
					this.make3DPoint(3.3732,-2.5686,-2.5117),
					this.make3DPoint(3.4241,-2.7789,-2.5117),
					this.make3DPoint(3.509,-2.9733,-2.5117),
					this.make3DPoint(3.6277,-3.1517,-2.5117),
					this.make3DPoint(3.7805,-3.3141,-2.5117),
					this.make3DPoint(3.9601,-3.453,-2.5117),
					this.make3DPoint(4.1595,-3.5611,-2.5117),
					this.make3DPoint(4.3787,-3.6382,-2.5117),
					this.make3DPoint(4.6177,-3.6846,-2.5117),
					this.make3DPoint(4.8766,-3.7,-2.5117),
					this.make3DPoint(5.1339,-3.684,-2.5117),
					this.make3DPoint(5.3736,-3.636,-2.5117),
					this.make3DPoint(5.5954,-3.556,-2.5117),
					this.make3DPoint(5.7996,-3.444,-2.5117),
					this.make3DPoint(5.9859,-3.3,-2.5117),
					this.make3DPoint(6.188,-3.075,-2.5117),
					this.make3DPoint(6.3504,-2.8,-2.5117),
					this.make3DPoint(6.4731,-2.475,-2.5117),
					this.make3DPoint(6.5562,-2.1,-2.5117),
					this.make3DPoint(7.7562,-2.3,-2.5117),
					this.make3DPoint(7.6162,-2.8618,-2.5117),
					this.make3DPoint(7.4086,-3.3566,-2.5117),
					this.make3DPoint(7.1334,-3.7845,-2.5117),
					this.make3DPoint(6.7906,-4.1453,-2.5117),
					this.make3DPoint(6.4747,-4.381,-2.5117),
					this.make3DPoint(6.1294,-4.5643,-2.5117),
					this.make3DPoint(5.7547,-4.6952,-2.5117),
					this.make3DPoint(5.3506,-4.7738,-2.5117),
					this.make3DPoint(4.9172,-4.8,-2.5117),
					this.make3DPoint(4.4161,-4.7637,-2.5117),
					this.make3DPoint(3.9422,-4.6549,-2.5117),
					this.make3DPoint(3.4953,-4.4734,-2.5117),
					this.make3DPoint(3.1894,-4.2953,-2.5117),
					this.make3DPoint(2.9217,-4.0873,-2.5117),
					this.make3DPoint(2.6921,-3.8496,-2.5117),
					this.make3DPoint(2.5008,-3.582,-2.5117),
					this.make3DPoint(2.35,-3.2952,-2.5117),
					this.make3DPoint(2.2424,-2.9994,-2.5117),
					this.make3DPoint(2.1778,-2.6948,-2.5117),
					this.make3DPoint(2.1562,-2.3813,-2.5117),
					this.make3DPoint(2.177,-2.0871,-2.5117),
					this.make3DPoint(2.2391,-1.8063,-2.5117),
					this.make3DPoint(2.3426,-1.5387,-2.5117),
					this.make3DPoint(2.4875,-1.2844,-2.5117),
					this.make3DPoint(2.6729,-1.0494,-2.5117),
					this.make3DPoint(2.898,-0.83984,-2.5117),
					this.make3DPoint(3.1628,-0.65567,-2.5117),
					this.make3DPoint(3.4672,-0.49688,-2.5117),
					this.make3DPoint(3.0678,-0.37398,-2.5117),
					this.make3DPoint(2.7135,-0.19902,-2.5117),
					this.make3DPoint(2.4041,0.02798,-2.5117),
					this.make3DPoint(2.1398,0.30703,-2.5117),
					this.make3DPoint(1.9283,0.6313,-2.5117),
					this.make3DPoint(1.7771,0.99394,-2.5117),
					this.make3DPoint(1.6865,1.395,-2.5117),
					this.make3DPoint(1.6562,1.8344,-2.5117),
					this.make3DPoint(1.6924,2.3155,-2.5117),
					this.make3DPoint(1.8009,2.7664,-2.5117),
					this.make3DPoint(1.9817,3.187,-2.5117),
					this.make3DPoint(2.2347,3.5774,-2.5117),
					this.make3DPoint(2.5602,3.9375,-2.5117),
					this.make3DPoint(2.9409,4.248,-2.5117),
					this.make3DPoint(3.3599,4.4895,-2.5117),
					this.make3DPoint(3.8172,4.662,-2.5117),
					this.make3DPoint(4.3129,4.7655,-2.5117),
					this.make3DPoint(4.8469,4.8,-2.5117),
					this.make3DPoint(5.3287,4.7699,-2.5117),
					this.make3DPoint(5.7766,4.6797,-2.5117),
					this.make3DPoint(6.1907,4.5294,-2.5117),
					this.make3DPoint(6.5709,4.319,-2.5117),
					this.make3DPoint(6.9172,4.0484,-2.5117),
					this.make3DPoint(7.2182,3.73,-2.5117),
					this.make3DPoint(7.4627,3.3759,-2.5117),
					this.make3DPoint(7.6505,2.9862,-2.5117),
					this.make3DPoint(7.7817,2.5609,-2.5117),
					this.make3DPoint(-0.04375,4.7,2.4883),
					this.make3DPoint(-0.04375,-4.8,2.4883),
					this.make3DPoint(-3.3359,-4.8,2.4883),
					this.make3DPoint(-4.318,-4.766,2.4883),
					this.make3DPoint(-5.0359,-4.6641,2.4883),
					this.make3DPoint(-5.5569,-4.505,2.4883),
					this.make3DPoint(-6.0241,-4.2779,2.4883),
					this.make3DPoint(-6.4375,-3.9828,2.4883),
					this.make3DPoint(-6.8993,-3.5206,2.4883),
					this.make3DPoint(-7.2764,-2.9797,2.4883),
					this.make3DPoint(-7.5688,-2.3602,2.4883),
					this.make3DPoint(-7.7771,-1.67,2.4883),
					this.make3DPoint(-7.9021,-0.9171,2.4883),
					this.make3DPoint(-7.9438,-0.10157,2.4883),
					this.make3DPoint(-7.8803,0.91836,2.4883),
					this.make3DPoint(-7.6898,1.8156,2.4883),
					this.make3DPoint(-7.4,2.5795,2.4883),
					this.make3DPoint(-7.0383,3.1992,2.4883),
					this.make3DPoint(-6.7648,3.5385,2.4883),
					this.make3DPoint(-6.4747,3.826,2.4883),
					this.make3DPoint(-6.168,4.0617,2.4883),
					this.make3DPoint(-5.8312,4.2546,2.4883),
					this.make3DPoint(-5.451,4.4135,2.4883),
					this.make3DPoint(-5.0273,4.5383,2.4883),
					this.make3DPoint(-4.3096,4.6596,2.4883),
					this.make3DPoint(-3.4922,4.7,2.4883),
					this.make3DPoint(-1.3438,3.6,2.4883),
					this.make3DPoint(-3.3719,3.6,2.4883),
					this.make3DPoint(-4.2098,3.5561,2.4883),
					this.make3DPoint(-4.8453,3.4242,2.4883),
					this.make3DPoint(-5.1776,3.291,2.4883),
					this.make3DPoint(-5.462,3.1256,2.4883),
					this.make3DPoint(-5.6984,2.9281,2.4883),
					this.make3DPoint(-5.9744,2.5946,2.4883),
					this.make3DPoint(-6.2064,2.192,2.4883),
					this.make3DPoint(-6.3945,1.7203,2.4883),
					this.make3DPoint(-6.5814,0.88008,2.4883),
					this.make3DPoint(-6.6438,-0.12188,2.4883),
					this.make3DPoint(-6.6132,-0.82778,2.4883),
					this.make3DPoint(-6.5215,-1.4471,2.4883),
					this.make3DPoint(-6.3687,-1.9797,2.4883),
					this.make3DPoint(-6.1547,-2.4258,2.4883),
					this.make3DPoint(-5.897,-2.7953,2.4883),
					this.make3DPoint(-5.6129,-3.0982,2.4883),
					this.make3DPoint(-5.3024,-3.3347,2.4883),
					this.make3DPoint(-4.9656,-3.5047,2.4883),
					this.make3DPoint(-4.5606,-3.6132,2.4883),
					this.make3DPoint(-4.0184,-3.6783,2.4883),
					this.make3DPoint(-3.3391,-3.7,2.4883),
					this.make3DPoint(-1.3438,-3.7,2.4883),
					this.make3DPoint(-0.04375,4.7,-2.5117),
					this.make3DPoint(-0.04375,-4.8,-2.5117),
					this.make3DPoint(-3.3359,-4.8,-2.5117),
					this.make3DPoint(-4.318,-4.766,-2.5117),
					this.make3DPoint(-5.0359,-4.6641,-2.5117),
					this.make3DPoint(-5.5569,-4.505,-2.5117),
					this.make3DPoint(-6.0241,-4.2779,-2.5117),
					this.make3DPoint(-6.4375,-3.9828,-2.5117),
					this.make3DPoint(-6.8993,-3.5206,-2.5117),
					this.make3DPoint(-7.2764,-2.9797,-2.5117),
					this.make3DPoint(-7.5688,-2.3602,-2.5117),
					this.make3DPoint(-7.7771,-1.67,-2.5117),
					this.make3DPoint(-7.9021,-0.9171,-2.5117),
					this.make3DPoint(-7.9438,-0.10157,-2.5117),
					this.make3DPoint(-7.8803,0.91836,-2.5117),
					this.make3DPoint(-7.6898,1.8156,-2.5117),
					this.make3DPoint(-7.4,2.5795,-2.5117),
					this.make3DPoint(-7.0383,3.1992,-2.5117),
					this.make3DPoint(-6.7648,3.5385,-2.5117),
					this.make3DPoint(-6.4747,3.826,-2.5117),
					this.make3DPoint(-6.168,4.0617,-2.5117),
					this.make3DPoint(-5.8312,4.2546,-2.5117),
					this.make3DPoint(-5.451,4.4135,-2.5117),
					this.make3DPoint(-5.0273,4.5383,-2.5117),
					this.make3DPoint(-4.3096,4.6596,-2.5117),
					this.make3DPoint(-3.4922,4.7,-2.5117),
					this.make3DPoint(-1.3438,3.6,-2.5117),
					this.make3DPoint(-3.3719,3.6,-2.5117),
					this.make3DPoint(-4.2098,3.5561,-2.5117),
					this.make3DPoint(-4.8453,3.4242,-2.5117),
					this.make3DPoint(-5.1776,3.291,-2.5117),
					this.make3DPoint(-5.462,3.1256,-2.5117),
					this.make3DPoint(-5.6984,2.9281,-2.5117),
					this.make3DPoint(-5.9744,2.5946,-2.5117),
					this.make3DPoint(-6.2064,2.192,-2.5117),
					this.make3DPoint(-6.3945,1.7203,-2.5117),
					this.make3DPoint(-6.5814,0.88008,-2.5117),
					this.make3DPoint(-6.6438,-0.12188,-2.5117),
					this.make3DPoint(-6.6132,-0.82778,-2.5117),
					this.make3DPoint(-6.5215,-1.4471,-2.5117),
					this.make3DPoint(-6.3687,-1.9797,-2.5117),
					this.make3DPoint(-6.1547,-2.4258,-2.5117),
					this.make3DPoint(-5.897,-2.7953,-2.5117),
					this.make3DPoint(-5.6129,-3.0982,-2.5117),
					this.make3DPoint(-5.3024,-3.3347,-2.5117),
					this.make3DPoint(-4.9656,-3.5047,-2.5117),
					this.make3DPoint(-4.5606,-3.6132,-2.5117),
					this.make3DPoint(-4.0184,-3.6783,-2.5117),
					this.make3DPoint(-3.3391,-3.7,-2.5117),
					this.make3DPoint(-1.3438,-3.7,-2.5117),
					this.make3DPoint(-0.04375,-2.7342,2.4883),
					this.make3DPoint(-0.04375,-2.7342,-2.5117),
					this.make3DPoint(-1.3438,-2.7342,2.4883),
					this.make3DPoint(-1.3438,-2.7342,-2.5117),
					this.make3DPoint(-0.36346,-2.7342,2.4883),
					this.make3DPoint(-0.36346,-2.7342,-2.5117),
					this.make3DPoint(-0.04375,-2.0456,-2.5117),
					this.make3DPoint(-0.04375,-2.0456,2.4883),
					this.make3DPoint(-1.3438,-2.0456,2.4883),
					this.make3DPoint(-1.3438,-2.0456,-2.5117),
					this.make3DPoint(-0.47003,-2.0456,2.4883),
					this.make3DPoint(-0.47003,-2.0456,-2.5117),
					this.make3DPoint(-0.04375,1.8228,-2.5117),
					this.make3DPoint(-0.04375,1.8228,2.4883),
					this.make3DPoint(-1.3438,1.8228,2.4883),
					this.make3DPoint(-1.3438,1.8228,-2.5117),
					this.make3DPoint(-1.0687,1.8228,2.4883),
					this.make3DPoint(-1.0687,1.8228,-2.5117),
					this.make3DPoint(-0.04375,2.7945,-2.5117),
					this.make3DPoint(-0.04375,2.7945,2.4883),
					this.make3DPoint(-1.3438,2.7881,2.4883),
					this.make3DPoint(-1.3438,2.7881,-2.5117),
					this.make3DPoint(-1.2182,2.7887,2.4883),
					this.make3DPoint(-1.2182,2.7887,-2.5117)
			];
            this.facesArray = [
			[0,1,121,120],
			[1,2,122,121],
			[2,3,123,122],
			[3,4,124,123],
			[4,5,125,124],
			[5,6,126,125],
			[6,7,127,126],
			[7,8,128,127],
			[8,9,129,128],
			[9,10,130,129],
			[10,11,131,130],
			[11,12,132,131],
			[12,13,133,132],
			[13,14,134,133],
			[14,15,135,134],
			[15,16,136,135],
			[16,17,137,136],
			[17,18,138,137],
			[18,19,139,138],
			[19,20,140,139],
			[20,21,141,140],
			[21,22,142,141],
			[22,23,143,142],
			[23,24,144,143],
			[24,25,145,144],
			[25,26,146,145],
			[26,27,147,146],
			[27,28,148,147],
			[28,29,149,148],
			[29,30,150,149],
			[30,31,151,150],
			[31,32,152,151],
			[32,33,153,152],
			[33,34,154,153],
			[34,35,155,154],
			[35,36,156,155],
			[36,37,157,156],
			[37,38,158,157],
			[38,39,159,158],
			[39,40,160,159],
			[40,41,161,160],
			[41,42,162,161],
			[42,43,163,162],
			[43,44,164,163],
			[44,45,165,164],
			[45,46,166,165],
			[46,47,167,166],
			[47,48,168,167],
			[48,49,169,168],
			[49,50,170,169],
			[50,51,171,170],
			[51,52,172,171],
			[52,53,173,172],
			[53,54,174,173],
			[54,55,175,174],
			[55,56,176,175],
			[56,57,177,176],
			[57,58,178,177],
			[58,59,179,178],
			[59,60,180,179],
			[60,61,181,180],
			[61,62,182,181],
			[62,63,183,182],
			[63,64,184,183],
			[64,65,185,184],
			[65,66,186,185],
			[66,67,187,186],
			[67,68,188,187],
			[68,69,189,188],
			[69,70,190,189],
			[70,71,191,190],
			[71,72,192,191],
			[72,73,193,192],
			[73,74,194,193],
			[74,75,195,194],
			[75,76,196,195],
			[76,77,197,196],
			[77,78,198,197],
			[78,79,199,198],
			[79,80,200,199],
			[80,81,201,200],
			[81,82,202,201],
			[82,83,203,202],
			[84,85,205,204],
			[85,86,206,205],
			[86,87,207,206],
			[87,88,208,207],
			[88,89,209,208],
			[89,90,210,209],
			[90,91,211,210],
			[91,92,212,211],
			[92,93,213,212],
			[93,94,214,213],
			[94,95,215,214],
			[95,96,216,215],
			[96,97,217,216],
			[97,98,218,217],
			[98,99,219,218],
			[99,100,220,219],
			[101,102,222,221],
			[102,103,223,222],
			[103,104,224,223],
			[104,105,225,224],
			[105,106,226,225],
			[106,107,227,226],
			[107,108,228,227],
			[108,109,229,228],
			[109,110,230,229],
			[110,111,231,230],
			[111,112,232,231],
			[112,113,233,232],
			[113,114,234,233],
			[114,115,235,234],
			[115,116,236,235],
			[116,117,237,236],
			[117,118,238,237],
			[118,119,239,238],
			[119,0,120,239],
			[119,2,1],
			[239,121,122],
			[113,112,7],
			[233,127,232],
			[1,0,119],
			[121,239,120],
			[118,3,2],
			[238,122,123],
			[4,3,117],
			[124,237,123],
			[115,5,4],
			[235,124,125],
			[6,5,114],
			[126,234,125],
			[7,6,113],
			[127,233,126],
			[8,7,112],
			[128,232,127],
			[9,8,111],
			[129,231,128],
			[10,9,110],
			[130,230,129],
			[11,10,109],
			[131,229,130],
			[12,11,109],
			[132,229,131],
			[13,12,108],
			[133,228,132],
			[14,13,107],
			[134,227,133],
			[15,14,106],
			[135,226,134],
			[101,100,19],
			[221,139,220],
			[17,16,104],
			[137,224,136],
			[18,17,103],
			[138,223,137],
			[19,18,102],
			[139,222,138],
			[85,84,44],
			[205,164,204],
			[81,80,47],
			[201,167,200],
			[94,20,95],
			[214,215,140],
			[39,38,92],
			[159,212,158],
			[94,21,20],
			[214,140,141],
			[23,22,94],
			[143,214,142],
			[93,23,94],
			[213,214,143],
			[35,34,31],
			[155,151,154],
			[92,27,26],
			[212,146,147],
			[29,28,37],
			[149,157,148],
			[31,30,35],
			[151,155,150],
			[32,31,33],
			[152,153,151],
			[30,29,36],
			[150,156,149],
			[34,33,31],
			[154,151,153],
			[25,24,93],
			[145,213,144],
			[36,35,30],
			[156,150,155],
			[37,36,29],
			[157,149,156],
			[92,37,28],
			[212,148,157],
			[91,90,40],
			[211,160,210],
			[40,39,91],
			[160,211,159],
			[41,40,89],
			[161,209,160],
			[42,41,88],
			[162,208,161],
			[43,42,87],
			[163,207,162],
			[44,43,85],
			[164,205,163],
			[45,44,83],
			[165,203,164],
			[46,45,82],
			[166,202,165],
			[47,46,81],
			[167,201,166],
			[48,47,79],
			[168,199,167],
			[49,48,78],
			[169,198,168],
			[50,49,77],
			[170,197,169],
			[51,50,76],
			[171,196,170],
			[52,51,75],
			[172,195,171],
			[53,52,74],
			[173,194,172],
			[54,53,73],
			[174,193,173],
			[55,54,73],
			[175,193,174],
			[56,55,72],
			[176,192,175],
			[57,56,71],
			[177,191,176],
			[58,57,70],
			[178,190,177],
			[59,58,69],
			[179,189,178],
			[60,59,68],
			[180,188,179],
			[61,60,66],
			[181,186,180],
			[62,61,65],
			[182,185,181],
			[64,63,62],
			[184,182,183],
			[65,64,62],
			[185,182,184],
			[66,65,61],
			[186,181,185],
			[67,66,60],
			[187,180,186],
			[68,67,60],
			[188,180,187],
			[69,68,59],
			[189,179,188],
			[70,69,58],
			[190,178,189],
			[71,70,57],
			[191,177,190],
			[72,71,56],
			[192,176,191],
			[73,72,55],
			[193,175,192],
			[74,73,53],
			[194,173,193],
			[75,74,52],
			[195,172,194],
			[76,75,51],
			[196,171,195],
			[77,76,50],
			[197,170,196],
			[78,77,49],
			[198,169,197],
			[79,78,48],
			[199,168,198],
			[80,79,47],
			[200,167,199],
			[82,81,46],
			[202,166,201],
			[83,82,45],
			[203,165,202],
			[84,83,44],
			[204,164,203],
			[86,85,43],
			[206,163,205],
			[87,86,43],
			[207,163,206],
			[94,22,21],
			[214,141,142],
			[88,87,42],
			[208,162,207],
			[89,88,41],
			[209,161,208],
			[93,24,23],
			[213,143,144],
			[90,89,40],
			[210,160,209],
			[93,92,26],
			[213,146,212],
			[26,25,93],
			[146,213,145],
			[38,37,92],
			[158,212,157],
			[92,91,39],
			[212,159,211],
			[92,28,27],
			[212,147,148],
			[96,95,20],
			[216,140,215],
			[20,19,100],
			[140,220,139],
			[97,96,20],
			[217,140,216],
			[98,97,20],
			[218,140,217],
			[99,98,20],
			[219,140,218],
			[100,99,20],
			[220,140,219],
			[16,15,105],
			[136,225,135],
			[102,101,19],
			[222,139,221],
			[103,102,18],
			[223,138,222],
			[104,103,17],
			[224,137,223],
			[105,104,16],
			[225,136,224],
			[106,105,15],
			[226,135,225],
			[107,106,14],
			[227,134,226],
			[108,107,13],
			[228,133,227],
			[109,108,12],
			[229,132,228],
			[110,109,10],
			[230,130,229],
			[111,110,9],
			[231,129,230],
			[112,111,8],
			[232,128,231],
			[114,113,6],
			[234,126,233],
			[115,114,5],
			[235,125,234],
			[116,115,4],
			[236,124,235],
			[117,116,4],
			[237,124,236],
			[118,117,3],
			[238,123,237],
			[119,118,2],
			[239,122,238],
			[241,242,292,291],
			[242,243,293,292],
			[243,244,294,293],
			[244,245,295,294],
			[245,246,296,295],
			[246,247,297,296],
			[247,248,298,297],
			[248,249,299,298],
			[249,250,300,299],
			[250,251,301,300],
			[251,252,302,301],
			[252,253,303,302],
			[253,254,304,303],
			[254,255,305,304],
			[255,256,306,305],
			[256,257,307,306],
			[257,258,308,307],
			[258,259,309,308],
			[259,260,310,309],
			[260,261,311,310],
			[261,262,312,311],
			[262,263,313,312],
			[263,264,314,313],
			[264,265,315,314],
			[265,240,290,315],
			[266,267,317,316],
			[267,268,318,317],
			[268,269,319,318],
			[269,270,320,319],
			[270,271,321,320],
			[271,272,322,321],
			[272,273,323,322],
			[273,274,324,323],
			[274,275,325,324],
			[275,276,326,325],
			[276,277,327,326],
			[277,278,328,327],
			[278,279,329,328],
			[279,280,330,329],
			[280,281,331,330],
			[281,282,332,331],
			[282,283,333,332],
			[283,284,334,333],
			[284,285,335,334],
			[285,286,336,335],
			[286,287,337,336],
			[287,288,338,337],
			[288,289,339,338],
			[277,276,254],
			[327,304,326],
			[258,257,273],
			[308,323,307],
			[259,258,272],
			[309,322,308],
			[262,261,270],
			[312,320,311],
			[260,259,272],
			[310,322,309],
			[261,260,271],
			[311,321,310],
			[263,262,269],
			[313,319,312],
			[267,266,265],
			[317,315,316],
			[265,264,268],
			[315,318,314],
			[266,240,265],
			[316,315,290],
			[264,263,268],
			[314,318,313],
			[268,267,265],
			[318,315,317],
			[269,268,263],
			[319,313,318],
			[270,269,262],
			[320,312,319],
			[257,256,274],
			[307,324,306],
			[275,274,256],
			[325,306,324],
			[271,270,261],
			[321,311,320],
			[272,271,260],
			[322,310,321],
			[256,255,275],
			[306,325,305],
			[273,272,258],
			[323,308,322],
			[255,254,276],
			[305,326,304],
			[274,273,257],
			[324,307,323],
			[254,253,277],
			[304,327,303],
			[252,251,278],
			[302,328,301],
			[253,252,277],
			[303,327,302],
			[276,275,255],
			[326,305,325],
			[251,250,279],
			[301,329,300],
			[249,248,281],
			[299,331,298],
			[250,249,280],
			[300,330,299],
			[278,277,252],
			[328,302,327],
			[279,278,251],
			[329,301,328],
			[248,247,282],
			[298,332,297],
			[280,279,250],
			[330,300,329],
			[247,246,283],
			[297,333,296],
			[281,280,249],
			[331,299,330],
			[246,245,284],
			[296,334,295],
			[282,281,248],
			[332,298,331],
			[245,244,285],
			[295,335,294],
			[283,282,247],
			[333,297,332],
			[244,243,286],
			[294,336,293],
			[284,283,246],
			[334,296,333],
			[285,284,245],
			[335,295,334],
			[243,242,287],
			[293,337,292],
			[286,285,244],
			[336,294,335],
			[287,286,243],
			[337,293,336],
			[242,241,289],
			[292,339,291],
			[288,287,242],
			[338,292,337],
			[289,288,242],
			[339,292,338],
			[340,241,291,341],
			[343,339,289,342],
			[344,241,340],
			[341,291,345],
			[342,289,241,344],
			[345,291,339,343],
			[349,343,342,348],
			[350,344,340,347],
			[346,341,345,351],
			[348,342,344,350],
			[351,345,343,349],
			[353,347,346,352],
			[355,349,348,354],
			[356,350,347,353],
			[352,346,351,357],
			[354,348,350,356],
			[357,351,349,355],
			[358,290,240,359],
			[361,355,354,360],
			[360,266,316,361],
			[362,356,353,359],
			[359,240,266,362],
			[358,352,357,363],
			[363,316,290,358],
			[360,354,356,362],
			[362,266,360],
			[363,357,355,361],
			[361,316,363],
			[203,341,346,204],
			[83,340,341,203],
			[83,84,347,340],
			[84,204,346,347],
			[100,353,352,220],
			[220,352,358,221],
			[101,221,358,359],
			[100,101,359,353]];
			<?php } ?>
            this.cubeAxisRotations = this.make3DPoint(0,0,0);
            
        }
        /**
         * loop
         * @returns {Void}
         * */
        Cube.prototype.loop = function() {
            //this.drawPoints(this.rotateCube(0.1,0.1));
            this.drawLines(this.rotateCube(0.1,0.1),this.boxmodel);
        }
        /**
         * drawPoints
         * @param {Array}
         * @returns {Void}
         * */
        Cube.prototype.drawPoints = function(screenPoints){
            let l = this.pointsArray.length;
            for (let i=0; i<l; i++){
                $w.canvas.circle(this.i,screenPoints[i].x + (W/2),screenPoints[i].y + (H/2),3 * screenPoints[i].scaleRatio,'#000000',1);
            }
        }
        /**
         * drawLines
         * @param {Array}
         * @returns {Void}
         * */
        Cube.prototype.drawLines = function(screenPoints){
            let l = this.facesArray.length,poly = [];
            let prev, fl = 0;
            for (let i=0; i<l; i++){
                if (0 == fl) {
                    fl = this.facesArray[0].length;
                }
                for(let j=0; j<fl; j++){
                    if (j==0) {
                        prev = this.facesArray[i][j];
                    }else{
                        if (undefined !== screenPoints[prev] && undefined !== screenPoints[this.facesArray[i][j]]) {
							$w.canvas.line(this.i,screenPoints[prev].x+(W/2),screenPoints[prev].y+(H/2),screenPoints[this.facesArray[i][j]].x+(W/2),screenPoints[this.facesArray[i][j]].y+(H/2));
						}
						prev = this.facesArray[i][j];
						
                    }
                }
            }
        }
        /**
         * make3DPoint
         * @param {Float}
         * @param {Float}
         * @param {Float}
         * @returns {Object}
         * */
        Cube.prototype.make3DPoint = function(x,y,z){
            let point = {
                x:x,
                y:y,
                z:z
            }
            return point;
        }
        /**
         * make2DPoint
         * @param {Float}
         * @param {Float}
         * @param {Number}
         * @param {Number}
         * @returns {Object}
         * */
        Cube.prototype.make2DPoint = function(x, y, depth, scaleRatio){
            let point = {
                x:x,
                y:y,
                depth:depth,
                scaleRatio:scaleRatio
            }
            return point;
        }
        /**
         * Transform3DPointsTo2DPoints
         * @param {Float}
         * @param {Number}
         * @returns {Array}
         * */
        Cube.prototype.Transform3DPointsTo2DPoints = function(points, axisRotations){
            // the array to hold transformed 2D points - the 3D points
            // from the point array which are here rotated and scaled
            // to generate a point as it would appear on the screen
            let TransformedPointsArray = [];
            // Math calcs for angles - sin and cos for each (trig)
            // this will be the only time sin or cos is used for the
            // entire portion of calculating all rotations
            let sx = Math.sin(axisRotations.x);
            let cx = Math.cos(axisRotations.x);
            let sy = Math.sin(axisRotations.y);
            let cy = Math.cos(axisRotations.y);
            let sz = Math.sin(axisRotations.z) * this.zOrigin;
            let cz = Math.cos(axisRotations.z) * this.zOrigin;
            
            // a couple of letiables to be used in the looping
            // of all the points in the transform process
            let x,y,z, xy,xz, yx,yz, zx,zy, scaleFactor;
        
            // 3... 2... 1... loop!
            // loop through all the points in your object/scene/space
            // whatever - those points passed - so each is transformed
            let i = points.length;
            while (i--){
                // apply Math to making transformations
                // based on rotations
                
                // assign letiables for the current x, y and z
                let x = points[i].x;
                let y = points[i].y;
                let z = points[i].z;
        
                // perform the rotations around each axis
                // rotation around x
                let xy = cx*y - sx*z;
                let xz = sx*y + cx*z;
                // rotation around y
                let yz = cy*xz - sy*x;
                let yx = sy*xz + cy*x;
                // rotation around z
                let zx = cz*yx - sz*xy;
                let zy = sz*yx + cz*xy;
                
                // now determine perspective scaling factor
                // yz was the last calculated z value so its the
                // final value for z depth
                let scaleRatio = this.focalLength/(this.focalLength + yz);
                // assign the new x, y and z (the last z calculated)
                x = zx*scaleRatio;
                y = zy*scaleRatio;
                z = yz;
                // create transformed 2D point with the calculated values
                // adding it to the array holding all 2D points
                TransformedPointsArray[i] = this.make2DPoint(x, y, -z, scaleRatio);
            }
            // after looping return the array of points as they
            // exist after the rotation and scaling
            return TransformedPointsArray;
        }
        /**
         * rotateCube
         * @param {Float}
         * @param {Float}
         * @returns {Array}
         * */
        Cube.prototype.rotateCube = function(x,y){
			// automatically rotate model for demo
			//this.cubeAxisRotations.x += x;
			this.cubeAxisRotations.y += y;
			//
            return this.Transform3DPointsTo2DPoints(this.pointsArray, this.cubeAxisRotations);
        }
        
        // ---------
		// Begin control functions
		// ---------
        
        /**
         * rotateModel
         * @param {Event}
         * @returns {Void}
         * */
        function rotateModel(event) {
            $w.objects.Cube[0].cubeAxisRotations.y = (-event.screenX) / 400;
            $w.objects.Cube[0].cubeAxisRotations.x = event.screenY / 400;
        }
		/**
		 * setZoom
		 * @param {Number}
		 * @returns {Void}
		 * */
		function setZoom(z) {
			$w.objects.Cube[0].zOrigin = z;
		}
    </script>
    <style>
		body {
			font-family: Arial;
		}
        .fltleft {
            width: 48%;
            float: left;
        }
        form {
            float: right;
        }
    </style>
</head>
<body>
    <div class="fltleft" id="target" ondrag="rotateModel(event)" draggable="true"></div>
    <div class="fltleft">
        <form action="#" method="post" enctype="multipart/form-data">
		    <h2></h2>
		    <input type="file" name="file" id="file" />
		    <input type="hidden" name="action" value="upload_an8" />
		    <div>
			<input type="submit" name="submit" value="Upload Anim8or File" />
		    </div>
		</form>
        <p>
            <h2>Import Anim8or 3D Model Using Javascript - Ver 2.0</h2>
			<h3>Jeremy Heminger</h3>
			<p><a href="http://www.jeremyheminger.com">www.jeremyheminger.com</a></p>
            <p>
                I recently was taking a Node.js course and became...side-tracked.
                <br />
                I decided to re-visit a program I made several years ago allowing an Anim8or 3D model to be imported and displayed in the browser.
                <br />
                I am a better programmer now and have a better grasp of the math so,...this works considerably better however it still only imports a single mesh.
            </p>
            <h3>
                Drag your mouse over the model to manually rotate it.
            </h3>
			<p>
				Zoom <input type="range" id="zoom" min="1" max="20" value="10" onchange="setZoom(this.value)">
			</p>
            <p>
				<h3>
					Upload *.an8 files using the form:
					<ol>
						<li>
							Click "Choose File"
						</li>
						<li>
							Select a file from your local machines file system.
						</li>
					</ol>
				</h3>
                <h4>
                    Here are a few sample models for demonstration purposes.
					<br />
					Right-click and Save-As or your browser will simply open them as text files.
                </h4>
                <ul>
                    <li>
                        <a href="models/cube.an8">Cube</a>
                    </li>
                    <li>
                        <a href="models/tetra.an8">Tetrahedron</a>
                    </li>
                    <li>
                        <a href="models/ico.an8">Icosphere</a>
                    </li>
					<li>
                        <a href="models/bird.an8">Anim8or Hello World Bird</a>
                    </li>
                    <li>
                        <a href="models/tank.an8">Battlezone Tank</a>
                    </li>
					<li>
                        <a href="models/utah.an8">The Utah Teapot</a>
                    </li>
                </ul>
            </p>
        <p>
            <h4>To Do</h4>
            <ul>
                <li>
                    Add faces to polygons with backface culling
                </li>
                <li>
                    Support for more file types: *.obj, *.x, *.mdl ... etc
                </li>
                <li>
                    Use Node.js instead of PHP to extract model data
                </li>
                <li>
                    Create a Battlezone Game
                </li>
                <li>
                    Shadows????
                </li>
            </ul>
        </p>
        </p>
    </div>
</body>
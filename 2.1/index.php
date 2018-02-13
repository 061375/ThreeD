<?php
//require_once('php/an8.2.0.1.class.php');
require_once('php/vtx.1.0.0.class.php');
define("MAX_BYTES",1000000);
$points = 0;
$faces = 0;
$action = isset($_POST['action']) ? $_POST['action'] : false;
$displayModel = false;
$an8 = new Vtx();
if ("upload_an8" == $action) {
    $result = $an8->uploadVtx();
	$name = $result['name'];
    if (false === $result)
		$an8->display_errors();
		$data = $an8->openVtx($result['file']);
		if (false === $data)
			$an8->display_errors();
			$result = $an8->prepareVtx($data);
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
	<script src="js/wes.mantooth.js?a=<?php echo strtotime('now'); ?>"></script>
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
			
			
			
			/* MODEL FOR FILE */
			
			
			
			var <?php echo str_replace('.vtx','',$name); ?>Model = {<?php echo str_replace('this.makeA3DPoint','$w.threed.makeA3DPoint',str_replace('this.pointsArray =','pointsArray:',str_replace(';','',$points))); ?>,<?php echo str_replace('this.facesArray = ','facesArray:',str_replace(';','',$faces)); ?>}
			
			
			
			/* END MODEL FOR FILE */
			<?php } else{ ?>
			
			
			this.pointsArray = [
                    $w.threed.makeA3DPoint(9.9853,9.9853,9.9853),
                    $w.threed.makeA3DPoint(9.9853,9.9853,-9.9853),
                    $w.threed.makeA3DPoint(0.14684,-9.9853,0),
                    $w.threed.makeA3DPoint(-9.9853,9.9853,9.9853),
                    $w.threed.makeA3DPoint(-9.9853,9.9853,-9.9853)
            ];
            this.facesArray = [
                [0,3,2],
                [1,2,4],
                [0,2,1],
                [3,4,2],
                [0,1,4],
				[4,3,0]
            ];
			
			<?php } ?>
            this.cubeAxisRotations = $w.threed.makeA3DPoint(0,0,0);
            
        }
        /**
         * loop
         * @returns {Void}
         * */
        Cube.prototype.loop = function() {
            //this.drawPoints(this.rotateCube(0.1,0.1));
            //$w.threed.drawLines(this.i,this.rotateCube(0.1,0.1),this.facesArray,(W/2),(H/2));
			//this.drawLines(this.rotateCube(0.1,0.1),(W/2),(H/2));
			this.drawPolygon(this.rotateCube(0.1,0.1),(W/2),(H/2));
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
        Cube.prototype.drawLines = function(screenPoints,x,y){
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
							$w.canvas.line(this.i,screenPoints[prev].x+x,screenPoints[prev].y+y,screenPoints[this.facesArray[i][j]].x+x,screenPoints[this.facesArray[i][j]].y+y);
						}
						prev = this.facesArray[i][j];
						
                    }
                }
            }
        }
		/**
         * drawPolygon
         * @param {Array}
         * @returns {Void}
         * */
        Cube.prototype.drawPolygon = function(screenPoints,x,y){
            let l = this.facesArray.length;
            let prev, fl = 0;
            for (let i=0; i<l; i++){
                if (0 == fl) {
                    fl = this.facesArray[0].length;
                }
				let poly = [];
				for(let j=0; j<fl; j++){
					if (undefined !== screenPoints[this.facesArray[i][j]]) 
						poly.push([screenPoints[this.facesArray[i][j]].x+x,screenPoints[this.facesArray[i][j]].y+y]);
                }
				if(this.backfaceCulling(poly))
					$w.canvas.polygon(this.i,poly,'#0088ff','fill','#0088ff');
            }
        }
        /**
         * makeA3DPoint
         * @param {Float}
         * @param {Float}
         * @param {Float}
         * @returns {Object}
         * */
        Cube.prototype.makeA3DPoint = function(x,y,z){
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
		 * backfaceCulling
		 * @param {Array}
		 * @returns {Boolean}
		 * */
		Cube.prototype.backfaceCulling = function(p) {
			if (((p[1][1]-p[0][1])/(p[1][0]-p[0][0])-
				 (p[2][1]-p[0][1])/(p[2][0]-p[0][0])<0) ^
				 (p[0][0]<=p[1][0] == p[0][0]>p[2][0])){
				return true;
			}else{
				return false;
			}
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
			//console.log(this.zOrigin);
			//console.log($w.threed.Transform3DPointsTo2DPoints(this.pointsArray, this.cubeAxisRotations, this.focalLength, this.zOrigin));
            return $w.threed.Transform3DPointsTo2DPoints(this.pointsArray, this.cubeAxisRotations, this.focalLength, this.zOrigin);
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
            $w.objects.Cube[0].cubeAxisRotations.y = (-event.screenX) / 200;
            $w.objects.Cube[0].cubeAxisRotations.x = event.screenY / 600;
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
            <h2>Import Anim8or 3D Model Using Javascript - Ver 2.1</h2>
			<h3>Jeremy Heminger</h3>
			<p><a href="http://www.jeremyheminger.com">www.jeremyheminger.com</a></p>
            <p>
                This version I added faces and backface culling. Unfortunately to achieve this I decided to switch to a Vertex model format *.vtx
				<br />
				This is mostly because it uses the standard triangles for the model instead of box modelling and the format is simpler.
            </p>
			<p>
				Anim8or allows the export of *.vtx models Object -> Export then selct Vertex (*.vtx).
			</p>
            <h3>
                Drag your mouse over the model to manually rotate it.
            </h3>
			<p>
				Zoom <input type="range" id="zoom" min="1" max="20" value="10" onchange="setZoom(this.value)">
			</p>
            <p>
				<h3>
					Upload *.vtx files using the form:
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
                    Add faces to polygons with backface culling - DONE
                </li>
                <li>
                    Support for more file types: *.obj, *.x, *.mdl ... etc
                </li>
                <li>
                    Use Node.js instead of PHP to extract model data
                </li>
                <li>
                    Create a Battlezone Game - nearly complete
                </li>
                <li>
                    Shadows????
                </li>
            </ul>
        </p>
        </p>
    </div>
</body>
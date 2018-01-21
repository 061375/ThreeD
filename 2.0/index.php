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
    if (false !== $result) {
		$data = $an8->openAn8($result['file']);
		if (0 !== $data) {
			$result = $an8->prepareAn8($data);
			if (0 !== $result) {
				$points = $an8->get3Dpoints($result);
				if(false === $points)
					$an8->display_errors();
				$points = $an8->make3Dpoints($points);
				if(false === $points)
					$an8->display_errors();
				$faces = $an8->get3Dfaces($result);
				$faces = $an8->make3Dfaces($faces);
				$displayModel = true;
			} else {
				$an8->display_errors();
			}
		} else {
			$an8->display_errors();
		}
    } else {
		$an8->display_errors();
    }
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
            
            <?php if (false !== $displayModel) { ?>
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
            <?php } ?>
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
            return this.Transform3DPointsTo2DPoints(this.pointsArray, this.cubeAxisRotations);
        }
        
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
		function setZoom(z) {
			$w.objects.Cube[0].zOrigin = z;
		}
    </script>
    <style>
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
            <h2>Import Anim8or 3D Model Using Javascript Ver 2.0</h2>
            <p>
                I recently was taking a Node.js course and became...side-tracked.
                <br />
                I decided to re-visit a program I made several years ago allowing an Anim8or 3D model to be imported and displayed in the browser.
                <br />
                I am a better programmer now and have a better grasp of the math so,...this works considerably better however it still only imports a single mesh.
            </p>
            <p>
                I made some modifcations to the PHP file as well.
            </p>
            <h3>
                Drag the screen to rotate the model.
            </h3>
			<p>
				Zoom <input type="range" id="zoom" min="1" max="20" value="10" onchange="setZoom(this.value)">
			</p>
            <p>
                <h4>
                    Here are a few sample models fot demonstration purposes.
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
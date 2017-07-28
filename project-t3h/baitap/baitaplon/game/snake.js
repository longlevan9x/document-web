// tao canvas
var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        // tao chieu rong - dai
		var w = canvas.width;
        var h = canvas.height;

        var widthUnit = 10;
        var direction; // huong di
        var keycode;
        var food;      // thuc an
        var score;     // diem

        var snake_size;

        function game_start() {
            game_run();
        }

        function game_run(game_loop) {
            direction = "right";
            create_snake();
            create_food();
            score = 0;

            if (typeof(game_loop) != "undefined") {
                clearInterval(game_loop);
            }
            
        }

        //tao ran
        function create_snake() {
            var length = 5;
            snake_size = new Array();
            for (var i = length-1; i>=0; i--) {
                snake_size.push({x: i, y : 1});
            }
        }

        // thuc an
        function create_food() {
            food = {
                x:Math.round(Math.random() * (w - widthUnit) / widthUnit),
                y:Math.round(Math.random() * (h - widthUnit) / widthUnit),
            };
        }
        //ve ran
        function paint_snake() {
            ctx.fillStyle= "#E5D4D4";
            ctx.fillRect(0, 0, w, h);// mau len la fill
            ctx.strokeStyle= "white"; // border
            ctx.strokeRect(0, 0, w, h);

            var head_x = snake_size[0].x;
            var head_y = snake_size[0].y; 

            if (direction == "right"){
                head_x++;
            }
            else if(direction == "left"){
                head_x--;
            }
            else if(direction == "up"){
                head_y--;
            }
            else if(direction == "down"){
                head_y++;
            }

            // va cham voi duong vien
            if (head_x == -1) {
                head_x = w / widthUnit;
                score--;
                snake_size.shift();
            }
            if (head_x > w /widthUnit) {
                head_x = 0;
                score--;
                snake_size.shift();
            }
            if (head_y == -1) {
                head_y = h / widthUnit;
                score--;
                snake_size.shift();
            }
            if (head_y > h / widthUnit) {
                head_y = 0;
                score--;
                snake_size.shift();
            }
            if (score == -1 || check_collision(head_x, head_y, snake_size)) {
                game_run();
                return;
            }
            // tao duoi ran
            if (head_x == food.x && head_y == food.y) {
                var tail = {x: head_x , y: head_y}// duoi ran
                create_food();
                score++;
            }
            else{
                var tail = snake_size.pop(); //pops out the last cell
                tail.x = head_x; tail.y = head_y;
            }

            snake_size.unshift(tail);
            for (var i = 0; i < snake_size.length; i++) {
                var snake = snake_size[i];
                paint_cell(snake.x, snake.y);
            }
            paint_cell(food.x,food.y);

            var score_text = "Score: " + score;
            ctx.fillStyle = "black";
            ctx.font = "20px Arial";
            ctx.fillText(score_text, 0, 20);
        }

        // ve duoi
        function paint_cell(x, y){
            ctx.fillStyle = "orange";
            ctx.fillRect(x * widthUnit, y * widthUnit, widthUnit, widthUnit);
            ctx.strokeStyle = "red";
            ctx.strokeRect(x * widthUnit, y * widthUnit, widthUnit, widthUnit);
        }

        // can duoi
        function check_collision(x, y, array) {
            for (var i = 0; i < array.length; i++) {
            if(array[i].x == x && array[i].y == y) return true;
            }
            return false;
        }

        // key event
        window.addEventListener("keydown",function (event) {
            var key = event.which;
            if (key == "37" && direction != "right") {
                direction = "left";
            }
            else if (key == "39" && direction != "left") {
                direction = "right";
            }
            else if (key == "40" && direction != "up") {
                direction = "down";
            }
            else if (key == "38" && direction != "down") {
                direction = "up";
            }
        });
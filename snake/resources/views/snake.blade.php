<!DOCTYPE html>
<html>
<head>
    <title>Snake Game</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f0f0f0;
        }
        canvas {
            background: #000;
            display: block;
        }
    </style>
</head>
<body>
    <canvas id="gameCanvas" width="400" height="400"></canvas>
    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        const gridSize = 20;
        const tileCount = canvas.width / gridSize;

        let snake = [{ x: 10, y: 10 }];
        let direction = { x: 0, y: 0 };
        let food = { x: 15, y: 15 };
        let score = 0;

        function gameLoop() {
            update();
            draw();
        }

        function update() {
            const head = { x: snake[0].x + direction.x, y: snake[0].y + direction.y };

            if (head.x === food.x && head.y === food.y) {
                snake.push({});
                score++;
                placeFood();
            }

            if (head.x < 0 || head.x >= tileCount || head.y < 0 || head.y >= tileCount || snake.some(segment => segment.x === head.x && segment.y === head.y)) {
                resetGame();
            }

            snake = [head, ...snake.slice(0, -1)];
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = 'red';
            ctx.fillRect(food.x * gridSize, food.y * gridSize, gridSize, gridSize);

            ctx.fillStyle = 'lime';
            snake.forEach(segment => ctx.fillRect(segment.x * gridSize, segment.y * gridSize, gridSize, gridSize));

            ctx.fillStyle = 'white';
            ctx.fillText(`Score: ${score}`, 10, 10);
        }

        function placeFood() {
            food = {
                x: Math.floor(Math.random() * tileCount),
                y: Math.floor(Math.random() * tileCount)
            };

            if (snake.some(segment => segment.x === food.x && segment.y === food.y)) {
                placeFood();
            }
        }

        function resetGame() {
            snake = [{ x: 10, y: 10 }];
            direction = { x: 0, y: 0 };
            score = 0;
            placeFood();
        }

        window.addEventListener('keydown', e => {
            const directions = {
                ArrowUp: { x: 0, y: -1 },
                ArrowDown: { x: 0, y: 1 },
                ArrowLeft: { x: -1, y: 0 },
                ArrowRight: { x: 1, y: 0 }
            };

            if (directions[e.key]) {
                direction = directions[e.key];
            }
        });

        setInterval(gameLoop, 100);
    </script>
</body>
</html>

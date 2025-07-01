<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Portfolio</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .contact-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            opacity: 0;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        label {
            display: block;
            color: #555;
            margin-bottom: 8px;
            font-size: 14px;
            opacity: 0;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
            opacity: 0;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.2);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            opacity: 0;
        }
        button:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            text-align: center;
            opacity: 0;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Me</h2>
        <div id="message" class="message" style="display: none;"></div>
        <form id="contact-form" action="contact.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message-input" name="message" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        // GSAP Animations
        document.addEventListener('DOMContentLoaded', () => {
            // Animate heading
            gsap.from('h2', {
                duration: 1,
                y: -50,
                opacity: 0,
                ease: 'power3.out'
            });

            // Animate form groups sequentially
            gsap.from('.form-group', {
                duration: 0.8,
                y: 30,
                opacity: 0,
                stagger: 0.2,
                ease: 'power2.out',
                delay: 0.5
            });

            // Animate button
            gsap.from('button', {
                duration: 0.8,
                scale: 0.8,
                opacity: 0,
                ease: 'back.out(1.7)',
                delay: 1.3
            });

            // Hover effect for button
            const button = document.querySelector('button');
            button.addEventListener('mouseenter', () => {
                gsap.to(button, {
                    duration: 0.3,
                    scale: 1.05,
                    ease: 'power2.out'
                });
            });
            button.addEventListener('mouseleave', () => {
                gsap.to(button, {
                    duration: 0.3,
                    scale: 1,
                    ease: 'power2.out'
                });
            });

            // Form submission handling
            const form = document.getElementById('contact-form');
            const messageDiv = document.getElementById('message');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                // Animate button on click
                gsap.to(button, {
                    duration: 0.2,
                    scale: 0.95,
                    yoyo: true,
                    repeat: 1,
                    ease: 'power1.inOut'
                });

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();

                    messageDiv.style.display = 'block';
                    messageDiv.className = 'message ' + (result.success ? 'success' : 'error');
                    messageDiv.textContent = result.message;

                    gsap.fromTo(messageDiv, 
                        { opacity: 0, y: 20 },
                        { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }
                    );

                    if (result.success) {
                        form.reset();
                    }
                } catch (error) {
                    messageDiv.style.display = 'block';
                    messageDiv.className = 'message error';
                    messageDiv.textContent = 'An error occurred. Please try again.';

                    gsap.fromTo(messageDiv, 
                        { opacity: 0, y: 20 },
                        { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }
                    );
                }
            });
        });
    </script>
</body>
</html>
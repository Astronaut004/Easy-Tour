<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Page</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
     <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

header {
    background-color: #4CAF50;
    color: white;
    padding: 1rem;
    text-align: center;
}

h1, h2 {
    margin: 0;
}

.testimonials {
    padding: 2rem;
    max-width: 800px;
    margin: auto;
}

.testimonial {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    flex-direction: column;
}

.testimonial p {
    font-style: italic;
    margin: 0;
}

.testimonial-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 0.5rem;
    font-size: 0.9rem;
    color: #555;
}

.username {
    font-weight: bold;
}

.timestamp {
    margin-left: auto;
    text-align: right;
}

.actions {
    margin-top: 1rem;
}

.actions button {
    margin-right: 0.5rem;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    font-size: 0.9rem;
    cursor: pointer;
}

.actions button:hover {
    background-color: #45a049;
}

.submit-testimonial {
    padding: 2rem;
    max-width: 600px;
    margin: auto;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 0.5rem;
}

input, textarea {
    padding: 0.5rem;
    margin-top: 0.2rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    margin-top: 1rem;
    padding: 0.7rem;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: white;
    font-size: 1rem;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

     </style>
</head>
<body>
    <header>
        <h1>Customer Testimonials</h1>
    </header>
    
    <section class="testimonials">
        <!-- Example testimonial -->
        <div class="testimonial">
            <p>"This service is amazing! Highly recommend to anyone."</p>
            <div class="testimonial-info">
                <span class="username">- John Doe</span>
                <span class="timestamp">Posted on July 31, 2024</span>
            </div>
            <div class="actions">
                <button class="upvote">Upvote</button>
                <button class="comment">Comment</button>
                <button class="report">Report</button>
            </div>
        </div>
        <!-- More testimonials can be added here -->
    </section>
    
    <section class="submit-testimonial">
        <h2>Submit Your Testimonial</h2>
        <form id="testimonial-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="testimonial">Testimonial:</label>
            <textarea id="testimonial" name="testimonial" rows="4" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </section>

    <script>
        document.getElementById('testimonial-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const testimonialText = document.getElementById('testimonial').value;
    const timestamp = new Date().toLocaleDateString();

    if (name && testimonialText) {
        const testimonialSection = document.querySelector('.testimonials');

        const newTestimonial = document.createElement('div');
        newTestimonial.className = 'testimonial';
        newTestimonial.innerHTML = `
            <p>"${testimonialText}"</p>
            <div class="testimonial-info">
                <span class="username">- ${name}</span>
                <span class="timestamp">Posted on ${timestamp}</span>
            </div>
            <div class="actions">
                <button class="upvote">Upvote</button>
                <button class="comment">Comment</button>
                <button class="report">Report</button>
            </div>
        `;

        testimonialSection.appendChild(newTestimonial);

        document.getElementById('testimonial-form').reset();
    } else {
        alert('Please fill in both fields.');
    }
});

    </script>
    <!-- <script src="scripts.js"></script> -->
</body>
</html>

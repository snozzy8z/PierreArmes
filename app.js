const express = require('express');
const bodyParser = require('body-parser');
const Joi = require('joi');
const nodemailer = require('nodemailer');
const cors = require('cors');

const app = express();
const port = 3000;

// Middleware
app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

// Validation schema with Joi
const schema = Joi.object({
    nom: Joi.string().required(),
    prenom: Joi.string().required(),
    email: Joi.string().email().required(),
    phone: Joi.string().required(),
    message: Joi.string().required()
});

// Route handler for form submission
app.post('/sendEmail', async (req, res) => {
    const { error, value } = schema.validate(req.body);

    if (error) {
        return res.status(400).send(error.details[0].message);
    }

    // Send email logic using Nodemailer
    try {
        const transporter = nodemailer.createTransport({
            service: 'gmail',
            auth: {
                user: process.env.GMAIL_USER, // your email from environment variable
                pass: process.env.GMAIL_PASS // your password from environment variable
            }
        });

        await transporter.sendMail({
            from: 'your-email@gmail.com',
            to: 'atoxmillenium@gmail.com', // Change this to your desired recipient email address
            subject: 'Nouveau message depuis le formulaire de contact',
            text: `
                Nom: ${value.nom}
                Prénom: ${value.prenom}
                Email: ${value.email}
                Téléphone: ${value.phone}
                Message: ${value.message}
            `
        });

        console.log('Email envoyé avec succès.');
        res.send('Message envoyé avec succès.');
    } catch (err) {
        console.error('Erreur lors de l\'envoi du message:', err);
        res.status(500).send('Erreur lors de l\'envoi du message.');
    }
});

// Start server
app.listen(port, () => {
    console.log(`Server is listening at http://localhost:${port}`);
});

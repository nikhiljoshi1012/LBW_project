# LBW_project



# Raga-Taal Notation System

## Introduction

This repository contains the code for a Raga-Taal Notation System. This system allows users to select a raga and a taal, and then input musical notations on a grid interface based on the selected taal's beats. The application provides a user-friendly interface to understand and use the musical notations associated with Indian classical music.

## Features

- **Raga Selection:** Allows the user to select a raga from a dropdown list.
- **Taal Selection:** Allows the user to select a taal from a dropdown list.
- **Notation Grid:** A dynamic grid for inputting musical notations. The number of columns adjusts based on the number of beats in the selected taal.
- **Saptak Handling:** Supports input of notes across three octaves: Madhya Saptak (normal), Mandra Saptak (lower), and Taar Saptak (higher).
- **Note Types:** Supports shuddha (natural), komal (flat), and tivra (sharp) notes.

## Files

- `index.html` - The main HTML file containing the structure of the application.
- `style.css` - The CSS file for styling the application.
- `script.js` - The JavaScript file containing the logic for dynamic grid generation and notation input.

## Usage

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/yourusername/raga-taal-notation-system.git
   cd raga-taal-notation-system
   ```

2. **Open the HTML File:**
   Open `index.html` in a web browser to start using the application.

## Details

### Screen 1 - Raga and Taal Selection

- **Select Name of the Raga:** 
  A dropdown list populated from a `raag_name_master` table (fields: `raag_id`, `raag_name`).
- **Select Name of the Taal:** 
  A dropdown list populated from a `taal_master` table (fields: `taal_id`, `taal_name`, `no_beats`).

### Screen 2 - Notation Interface

- **Grid Setup:**
  - The number of columns is determined by the selected taal's number of beats.
  - Each cell in the grid represents one beat and can contain 1 to 4 swaras (notes).

- **Notation Input:**
  - Notes are input using specific characters representing different saptaks and types of notes.
  - **Madhya Saptak:** Normal octave notes are written without any symbol.
  - **Mandra Saptak:** Lower octave notes are written with a dot below the letter.
  - **Taar Saptak:** Higher octave notes are written with a dot above the letter.
  - **Komal (Flat) Notes:** Represented with a special sign (usually an underline or similar).
  - **Tivra (Sharp) Notes:** Typically represented with a different special sign.

### Examples of Notation Signs

- **Madhya Saptak:** सा, रे, ग, म, प, ध, नी, सां
- **Mandra Saptak:** स़ा, रे़, ग़, म़, प़, ध़, नी़, सां़
- **Taar Saptak:** साँ, रेँ, गँ, माँ, पँ, धँ, नीँ, सांँ
- **Komal Notes in Taar Saptak:** नीँ
- **Komal Notes in Mandra Saptak:** नी़



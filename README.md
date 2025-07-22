# 🏠 BSAPROPERTY – WordPress Property Theme

A custom WordPress theme for managing and displaying property listings using **Advanced Custom Fields PRO (ACF PRO)** and custom Gutenberg blocks.

---

## 📁 Folder Structure
```
BSAPROPERTY/
├── acf-json/ # Local JSON field groups for ACF sync
├── blocks/ # Custom Gutenberg blocks
├── content/ # WordPress demo content export
│ └── blacksmith.WordPress.2025-07-22 (1).xml
├── includes/ # PHP logic files
├── parts/ # Template parts
├── templates/ # Theme templates
├── functions.php # Theme functions and hooks
├── index.php # Base theme file
├── style.css # Theme stylesheet
├── theme.json # Theme configuration
└── README.md # Project instructions
```

## ✅ Setup Instructions

Follow the steps below to set up and run the project locally:

### 1. 📦 Download the Repository

- Download this repository as a `.zip` file and extract it into your `/wp-content/themes/` directory.
- Or clone it using Git:

  ```bash
  git clone https://github.com/LeopoldoLira/BSAPROPERTY.git
  ```

### 2. 🔌 Install ACF PRO
This theme relies on Advanced Custom Fields PRO.

You can use the free version hosted on GitHub:
👉 https://github.com/wp-premium/advanced-custom-fields-pro

⚠️ Use at your own discretion. For commercial use, purchase an official ACF PRO license.

### 3. 🗂 Import Demo Content
In your WordPress dashboard, go to:

Tools → Import → WordPress
Install the importer if prompted.

Import the XML file located at:
```bash
  /content/blacksmith.WordPress.2025-07-22 (1).xml
```

### 4. 🧩 Sync ACF Field Groups
Navigate to:

Custom Fields → Field Groups
ACF will show a “Sync Available” message.

Select all field groups and click “Sync” to register the local JSON field groups stored in /acf-json/.

## 🛠 SCSS Compilation
You can compile SCSS using any of the following in VS Code:

### Live Sass Compiler
👉 https://marketplace.visualstudio.com/items?itemName=glenn2223.live-sass

### Gulp or Webpack if you prefer CLI-based builds

## 📚 Notes
This theme does not rely on third-party page builders.

Supports manual property selection, taxonomy filters, and custom ACF Blocks.
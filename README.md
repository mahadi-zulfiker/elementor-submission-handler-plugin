# Elementor Submission Handler Plugin

## Description
The **Elementor Submission Handler Plugin** extends **Elementor Forms** by providing a custom way to **process form submissions**. This plugin allows developers to capture form data and handle it programmatically, enabling **custom actions** such as storing form data, sending API requests, or triggering automated workflows.

## Features
✅ **Custom Submission Handling** – Process Elementor form submissions programmatically  
✅ **Extend Elementor Forms** – Adds flexibility to Elementor’s default form submission system  
✅ **API & Database Integration Ready** – Easily extend to connect with external APIs or databases  
✅ **Lightweight & Developer-Friendly** – Simple, efficient, and easy to modify  

---

## Installation

### 1️⃣ Upload & Activate
1. **Download or Clone** this repository  
2. Upload the plugin to `wp-content/plugins/` directory  
3. Activate it from the **WordPress Admin Panel** → **Plugins**  

### 2️⃣ Configure in Elementor
1. Go to **Elementor Editor**  
2. Add a **Form Widget**  
3. Set up form fields as needed  
4. In the **Actions After Submit** section, select **Custom Submission Handler**  

---

## Usage

### ✅ **How It Works**
- When a user submits an **Elementor form**, the plugin intercepts the request.  
- The plugin executes **custom actions**, such as saving data or sending it to an API.  
- Developers can modify the plugin to extend its functionality based on project requirements.  

### ✅ **Customizing the Submission Handling**
Modify the **submission handler function** in the plugin’s core file to implement your own logic.

---

## Hooks & Filters

### **Action Hooks**
- `elementor_pro/forms/new_record` – Intercepts Elementor form submissions  

### **Filters**
- `custom_submission_handler_process` – Modify how form data is processed  

---

## Contributing
Feel free to fork this repository, submit pull requests, or report issues.  
For contributions and support, contact **amitavrchy01@gmail.com**.  

---

## License
This plugin is licensed under the **GPL-2.0+**.  

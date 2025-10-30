
# 🧾 Midterm Project — Inventory Management System

## 📘 Description / Overview
This project is a **Midterm Examination System Project** for the course **System Integration & Architecture 2**.  
It is a **basic Inventory Management Web Application** that allows users to manage, update, and track items in stock.  

The project also demonstrates proper **Git and GitHub workflow**, including creating repositories, pushing commits, branching, merging, and collaborating with partners through GitHub.

---

## 🎯 Objectives
- To apply Git and GitHub commands in a real project setup.  
- To demonstrate collaboration using **branching, cloning, and merging**.  
- To design a simple **Inventory Management System** using Laravel Framework and MySQL.  
- To understand and practice **version control** in a team environment.  
- To document the process and workflow.

---

## ⚙️ Features / Functionality
- 📦 **Add / Edit / Delete Inventory Items**
- 🧾 **View Inventory List**
- 🔍 **Search and Filter Items**
- 🌐 **Database Integration with MySQL**
- 🔄 **GitHub Branching for Partner Collaboration**

---

## 🧩 Installation Instructions

Follow these steps to set up the project locally:

### 1️⃣ Clone the Repository
If this is your own repository:
```bash
git clone https://github.com/YourUsername/mid-exam.git
````

If you are cloning your **partner’s branch**:

```bash
git clone -b partner-branch https://github.com/PartnerUsername/mid-exam.git
```

### 2️⃣ Open the Project

Open folder in **Visual Studio** 

### 3️⃣ Setup Database

* Import the MySQL database .
* Update your `.env` connection string with your local MySQL credentials.

### 4️⃣ Run the Project

* Press `F5` or click **Start Debugging** in Visual Studio.
* The system will launch in your default web browser.

---

## 💻 Usage

Once the project is running:

1. Navigate to the **Inventory Page**.
2. Add new items with their name, quantity, and description.
3. Edit or delete items when necessary.
4. Use the search bar to filter inventory items.

Example Command Line Workflow for GitHub Collaboration:

```bash
# Create a new branch for your work
git checkout -b partner-branch

# Add and commit your changes
git add .
git commit -m "Updated inventory module"

# Push your branch to GitHub
git push -u origin partner-branch
```

---

## 🖼️ Screenshots or Code Snippets

### 📷 Example Screenshot

![Inventory System Screenshot](assets/sys 1 (1).png)

### 💻 Example Code Snippet

```sql
// Sample code snippet for inserting a new inventory item
string query = "INSERT INTO items (name, quantity, description) VALUES (@name, @qty, @desc)";
MySqlCommand cmd = new MySqlCommand(query, conn);
cmd.Parameters.AddWithValue("@name", txtName.Text);
cmd.Parameters.AddWithValue("@qty", txtQuantity.Text);
cmd.Parameters.AddWithValue("@desc", txtDescription.Text);
cmd.ExecuteNonQuery();
```

---

## 🤝 Contributors

| Name               | Role                         |
| ------------------ | ---------------------------- |
| **John Fortes**    | Developer / Repository Owner |
| **[Partner Name]** | Collaborator / Contributor   |

---

## 📜 License

This project is licensed under the **MIT License** — you are free to use, modify, and distribute this project with proper attribution.

---

## 🧠 GitHub Command Activities Summary

### 1–2. Create Local Repository & Add Files

```bash
git init
git add .
```

### 3–4. Commit & Configure Identity

```bash
git commit -m "Initial commit"
git config --global user.name "Your Name"
git config --global user.email "youremail@example.com"
```

### 5–6. Connect to Remote Repo & Push

```bash
git remote add origin https://github.com/YourUsername/mid-exam.git
git branch -M main
git push -u origin main
```

### 7–8. Clone Partner Repo & Create Branch

```bash
git clone https://github.com/PartnerUsername/mid-exam.git
cd mid-exam
git checkout -b partner-branch
```

### 9–10. Commit Changes & Compare

```bash
git add .
git commit -m "Added updates by John"
git diff main
```

### 11–12. Merge & Delete Branch

```bash
git checkout main
git merge partner-branch
git branch -d partner-branch
```

### 13–14. Fetch & Pull Updates

```bash
git fetch
git pull origin main
```

### 15. Undo or Restore Changes

```bash
git reset HEAD filename.txt
git checkout -- filename.txt
git reset --hard HEAD~1
```

---

⭐ **Tip:** Always pull the latest changes before starting work:

```bash
git pull origin main
```

And always push your branch after committing:

```bash
git push -u origin your-branch-name
```

---

📌 *End of README — Midterm Project Documentation*


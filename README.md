# 📝 YNION – Note Collaboration App

**“Your note is our note.”**  
YNION is a real-time note-collaborating app that allows you to create, share, and collaborate on notes with your friends or team. Whether you're brainstorming ideas, planning a project, or reviewing for exams — YNION makes teamwork easier and more efficient.

---

## 🔗 Links

- **ELPHP GitHub Repository**: [ELPHP_TEAM_YEY_1130SAT](https://github.com/Nahhmiehh/ELPHP_TEAM_YEY_1130SAT)  
- **ELAND GitHub Repository**: [ELAND_TEAM_YEY_430SAT](https://github.com/Nahhmiehh/ELAND_TEAM_YEY_430SAT)  
- **Project Document**: [Google Docs](https://docs.google.com/document/d/1TrEWjK6FieIg-DqyBIte-UaRfpGGMI0S/edit)
- **Test Plan Spreadsheet**: [Google Sheets](https://docs.google.com/spreadsheets/d/1EFdXpdOcMfoxd5rXOfGMFA8v_uza6DsZnxpJ5Qo72hE/edit?usp=sharing)

---

# Ynion API Endpoints

This API allows interaction with the Ynion platform, including managing users, media, notes, history edits, and collaborations. All endpoints are prefixed with:

```
https://tristrac-api.yeems214.xyz/public/
```

---

## A.) Users

### 1. Create User
**POST** `/users`  
```json
{
  "username": "john_doe",
  "email": "john@example.com",
  "password": "123456",
  "profilePicture": "profile.jpg"
}
```

### 2. Get All Users
**GET** `/users`

### 3. Get User by Email
**GET** `/users/john@example.com`

### 4. Update User by ID
**PUT** `/users/1`  
```json
{
  "username": "john_updated",
  "email": "john_updated@example.com",
  "profilePicture": "updated.jpg"
}
```

### 5. Delete User by ID
**DELETE** `/users/1`

---

## B.) Media

### 1. Create Media
**POST** `/media`  
```json
{
  "userID": 1,
  "mediaName": "Sample Image",
  "mediaType": "image/png",
  "dateUploaded": "2025-05-03 14:30:00",
  "attributes": "{\"width\": 1024, \"height\": 768}",
  "positionXY": "100,200"
}
```

### 2. Get All Media
**GET** `/media`

### 3. Get Media by ID
**GET** `/media/1`

### 4. Update Media by ID
**PUT** `/media/1`  
```json
{
  "userID": 2,
  "mediaName": "Update Image",
  "mediaType": "image/png",
  "dateUploaded": "2025-05-03 14:30:00",
  "attributes": "{\"width\": 1024, \"height\": 768}",
  "positionXY": "200,400"
}
```

### 5. Delete Media by ID
**DELETE** `/media/1`

---

## C.) Notes

### 1. Create Note
**POST** `/note`  
```json
{
  "ownerID": 1,
  "mediaID": 2,
  "title": "Sample Note",
  "content": "This is the content of the sample note.",
  "createdAt": "2025-05-03 14:30:00",
  "updatedAt": "2025-05-03 14:30:00"
}
```

### 2. Get All Notes
**GET** `/note`

### 3. Get Note by ID
**GET** `/note/1`  
```json
{
  "NoteID": 1,
  "OwnerID": 1,
  "MediaID": 2,
  "Title": "Sample Note",
  "Content": "This is the content of the sample note.",
  "createdAt": "2025-05-03 14:30:00",
  "updatedAt": "2025-05-03 14:30:00"
}
```

### 4. Update Note by ID
**PUT** `/note/1`  
```json
{
  "ownerID": 1,
  "mediaID": 2,
  "title": "Updated Note",
  "content": "This is the updated content.",
  "updatedAt": "2025-05-03 15:00:00"
}
```

### 5. Delete Note by ID
**DELETE** `/note/1`

---

## D.) History

### 1. Create History Record
**POST** `/history`  
```json
{
  "noteID": 1,
  "userID": 2,
  "contentSnap": "Snapshot of the note content",
  "dateEdite": "2025-05-03 14:30:00",
  "editedBy": 2
}
```

### 2. Get All History Records
**GET** `/history`

### 3. Get History by ID
**GET** `/history/1`  
```json
{
  "HistoryID": 1,
  "NoteID": 1,
  "UserID": 2,
  "contentSnap": "Snapshot of the note content",
  "dateEdite": "2025-05-03 14:30:00",
  "editedBy": 2
}
```

### 4. Update History Record
**PUT** `/history/1`  
```json
{
  "noteID": 1,
  "userID": 2,
  "contentSnap": "Updated snapshot of the content",
  "dateEdite": "2025-05-03 15:00:00",
  "editedBy": 3
}
```

### 5. Delete History Record by ID
**DELETE** `/history/1`

---

## E.) Collaboration

### 1. Create Collaboration
**POST** `/collaboration`  
```json
{
  "noteID": 1,
  "userID": 2,
  "permission": "read",
  "createdAt": "2025-05-03 14:30:00",
  "updatedAt": "2025-05-03 14:30:00"
}
```

### 2. Get All Collaborations
**GET** `/collaboration`

### 3. Get Collaboration by ID
**GET** `/collaboration/1`  
```json
{
  "CollaborationID": 1,
  "NoteID": 1,
  "UserID": 2,
  "Permission": "read",
  "createdAt": "2025-05-03 14:30:00",
  "updatedAt": "2025-05-03 14:30:00"
}
```

### 4. Update Collaboration by ID
**PUT** `/collaboration/1`  
```json
{
  "noteID": 1,
  "userID": 2,
  "permission": "write",
  "updatedAt": "2025-05-03 15:00:00"
}
```

### 5. Delete Collaboration by ID
**DELETE** `/collaboration/1`

---

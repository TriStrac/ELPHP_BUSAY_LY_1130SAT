Ynion Api endpoint how to use:
A.) Users
	1.) Create User
	POST	http://localhost:8000/public/users
	{
  		"username": "john_doe",
 		"email": "john@example.com",
  		"password": "123456",
  		"profilePicture": "profile.jpg"
	}
	2.) Get All Users
	GET	http://localhost:8000/public/users
	3.) Get Users by Email
	GET	http://localhost:8000/public/users/john@example.com
	4.) Update User by Id
	PUT	http://localhost:8000/public/users/1
	{
  		"username": "john_updated",
  		"email": "john_updated@example.com",
  		"profilePicture": "updated.jpg"
	}
	5.) Delete User by ID
	DELETE	http://localhost:8000/public/users/1

B.) Media
	1.) Create Media
	POST	http://localhost:8000/public/media
	{
  		"userID": 1, //User should exist
 	 	"mediaName": "Sample Image",
  		"mediaType": "image/png",
  		"dateUploaded": "2025-05-03 14:30:00",
  		"attributes": "{\"width\": 1024, \"height\": 768}",
  		"positionXY": "100,200"
	}
	2.) Get All Media
	GET	http://localhost:8000/public/media
	3.) Get Media by Id
	GET	http://localhost:8000/public/media/1
	4.) Update Media by Id
	PUT	http://localhost:8000/public/media/1
	{
  		"userID": 2, //User should exist
 	 	"mediaName": "Update Image",
  		"mediaType": "image/png",
  		"dateUploaded": "2025-05-03 14:30:00",
  		"attributes": "{\"width\": 1024, \"height\": 768}",
  		"positionXY": "200,400"
	}
	5.) Delete media by ID
	DELETE	http://localhost:8000/public/media/1

C.) Notes
	1.) Create Note
	POST	http://localhost:8000/public/notes
	Request Body:
	{
    		"ownerID": 1,         // User should exist
    		"mediaID": 2,         // Media should exist
    		"title": "Sample Note",
    		"content": "This is the content of the sample note.",
    		"createdAt": "2025-05-03 14:30:00",
    		"updatedAt": "2025-05-03 14:30:00"
	}
	2.) Get All Notes
	GET	http://localhost:8000/public/notes
	3.) Get Note by ID
	GET	http://localhost:8000/public/notes/1
	{
    		"NoteID": 1,
    		"OwnerID": 1,
    		"MediaID": 2,
    		"Title": "Sample Note",
    		"Content": "This is the content of the sample note.",
    		"createdAt": "2025-05-03 14:30:00",
    		"updatedAt": "2025-05-03 14:30:00"
	}
	4.) Update Note by ID
	PUT	http://localhost:8000/public/notes/1
	{
    		"ownerID": 1,         // User should exist
    		"mediaID": 2,         // Media should exist
    		"title": "Updated Note",
    		"content": "This is the updated content.",
    		"updatedAt": "2025-05-03 15:00:00"
	}
	5.) Delete Note by ID
	DELETE	http://localhost:8000/public/notes/1

D.) History
	1.) Create History Record
	POST	http://localhost:8000/public/history
	{
    		"noteID": 1,           // Note should exist
    		"userID": 2,           // User should exist
    		"contentSnap": "Snapshot of the note content",
    		"dateEdite": "2025-05-03 14:30:00",
    		"editedBy": 2          // User who edited the note
	}
	2.) Get All History Records
	GET	http://localhost:8000/public/history
	3.) Get History by ID
	GET	http://localhost:8000/public/history/1
	{
    		"HistoryID": 1,
    		"NoteID": 1,
    		"UserID": 2,
    		"contentSnap": "Snapshot of the note content",
    		"dateEdite": "2025-05-03 14:30:00",
    		"editedBy": 2
	}
	4.) Update History Record
	PUT	http://localhost:8000/public/history/1
	{
    		"noteID": 1,           // Note should exist
    		"userID": 2,           // User should exist
    		"contentSnap": "Updated snapshot of the content",
    		"dateEdite": "2025-05-03 15:00:00",
    		"editedBy": 3          // New user who edited the note
	}
	5.) Delete History Record by ID
	DELETE	http://localhost:8000/public/history/1

E.) Collaboration
	1.) Create Collaboration
	POST	http://localhost:8000/public/collaboration
	{
   		"noteID": 1,           // Note should exist
    		"userID": 2,           // User should exist
    		"permission": "read",  // Permission can be "read", "write", etc.
    		"createdAt": "2025-05-03 14:30:00",
    		"updatedAt": "2025-05-03 14:30:00"
	}
	2.) Get All Collaborations
	GET	http://localhost:8000/public/collaboration
	3.) Get Collaboration by ID
	GET	http://localhost:8000/public/collaboration/1
	{
    		"CollaborationID": 1,
    		"NoteID": 1,
    		"UserID": 2,
    		"Permission": "read",
    		"createdAt": "2025-05-03 14:30:00",
    		"updatedAt": "2025-05-03 14:30:00"
	}
	4.) Update Collaboration by ID
	PUT	http://localhost:8000/public/collaboration/1
	{
    		"noteID": 1,           // Note should exist
    		"userID": 2,           // User should exist
    		"permission": "write", // Permission can be "read", "write", etc.
    		"updatedAt": "2025-05-03 15:00:00"
	}
	5.) Delete Collaboration by ID
	DELETE	http://localhost:8000/public/collaboration/1


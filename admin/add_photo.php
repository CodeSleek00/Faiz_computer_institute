<!DOCTYPE html>
<html>
<head>
    <title>Upload Photos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        form { width: 400px; padding: 20px; border: 1px solid #ccc; }
        input, select, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px; background: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

<h2>Upload Multiple Photos</h2>

<form action="upload_multi.php" method="POST" enctype="multipart/form-data">
    
    <label>Choose Category</label>
    <select name="category" required>
        <option value="Classroom">Classroom</option>
        <option value="Office">Office</option>
        <option value="Computer Lab">Computer Lab</option>
        <option value="Gallery">Gallery</option>
        <option value="Events">Events</option>
    </select>

    <label>Caption (same caption for all images)</label>
    <textarea name="caption" placeholder="Enter caption (optional)"></textarea>

    <label>Select Multiple Images</label>
    <input type="file" name="photos[]" multiple required>

    <button type="submit">Upload All</button>
</form>

</body>
</html>

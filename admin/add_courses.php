
<?php // add_course.php - place alongside db_connect.php
require '../db/db_connect.php';
// fetch companies for dropdown (optional)
$companies = $pdo->query('SELECT id,name FROM companies ORDER BY name')->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Add Course</title>
  <style>
    body{font-family:Inter,Arial;padding:20px;background:#f7f8fb}
    .card{background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.05);max-width:900px;margin:auto}
    .row{display:flex;gap:12px}
    .col{flex:1}
    .field{margin-bottom:12px}
    label{display:block;margin-bottom:6px;font-weight:600}
    input[type=text],input[type=file],textarea,select{width:100%;padding:8px;border:1px solid #ddd;border-radius:6px}
    button{padding:10px 14px;border:0;background:#2563eb;color:#fff;border-radius:8px}
    .muted{color:#666;font-size:13px}
    .list-item{background:#f3f4f6;padding:10px;border-radius:6px;margin-bottom:8px}
  </style>
</head>
<body>
  <div class="card">
    <h2>Add / Create Course</h2>
    <form id="courseForm" action="save_course.php" method="post" enctype="multipart/form-data">
      <div class="field">
        <label>Course Title</label>
        <input type="text" name="title" required>
      </div>

      <div class="field row">
        <div class="col">
          <label>Duration (e.g., 30 days / 3 months)</label>
          <input type="text" name="duration">
        </div>
        <div class="col">
          <label>Company / Partner</label>
          <select name="company_id">
            <option value="">-- Select Company --</option>
            <?php foreach($companies as $c): ?>
              <option value="<?=htmlspecialchars($c['id'])?>"><?=htmlspecialchars($c['name'])?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="field">
        <label>Course Image</label>
        <input type="file" name="course_image" accept="image/*">
        <div class="muted">Recommended: 800x500 px</div>
      </div>

      <hr>
      <h3>Syllabus / Sections</h3>
      <div id="syllabusContainer"></div>
      <div style="margin-bottom:12px">
        <button type="button" onclick="addSyllabus()">+ Add Syllabus Item</button>
      </div>

      <hr>
      <h3>Documents / Resources</h3>
      <div id="docsContainer"></div>
      <div style="margin-bottom:12px">
        <button type="button" onclick="addDoc()">+ Add Document</button>
      </div>

      <hr>
      <h3>Fees (groups & items)</h3>
      <div id="feeGroupsContainer"></div>
      <div style="margin-bottom:12px">
        <button type="button" onclick="addFeeGroup()">+ Add Fee Group (eg: Admission, Monthly)</button>
      </div>

      <hr>
      <div class="field row">
        <div class="col">
          <label>Total Exams</label>
          <input type="number" name="total_exams" min="0" value="0">
        </div>
        <div class="col"></div>
      </div>

      <div style="margin-top:18px">
        <button type="submit">Save Course</button>
      </div>
    </form>
  </div>

<script>
let syllabusIndex = 0;
let docIndex = 0;
let feeGroupIndex = 0;

function addSyllabus(){
  syllabusIndex++;
  const id = 'syl_'+syllabusIndex;
  const html = `
  <div class="list-item" id="${id}">
    <div style="display:flex;gap:8px;align-items:center">
      <strong>Item ${syllabusIndex}</strong>
      <button type="button" onclick="removeEl('${id}')">Remove</button>
    </div>
    <div style="margin-top:8px">
      <input type="text" name="syllabus_title[]" placeholder="Section title" required>
    </div>
    <div style="margin-top:8px">
      <textarea name="syllabus_desc[]" placeholder="Description (optional)" rows="2"></textarea>
    </div>
  </div>`;
  document.getElementById('syllabusContainer').insertAdjacentHTML('beforeend', html);
}

function addDoc(){
  docIndex++;
  const id = 'doc_'+docIndex;
  const html = `
  <div class="list-item" id="${id}">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <strong>Document ${docIndex}</strong>
      <button type="button" onclick="removeEl('${id}')">Remove</button>
    </div>
    <div style="margin-top:8px">
      <input type="file" name="documents[]" required>
    </div>
  </div>`;
  document.getElementById('docsContainer').insertAdjacentHTML('beforeend', html);
}

function addFeeGroup(){
  feeGroupIndex++;
  const id = 'fee_'+feeGroupIndex;
  const html = `
  <div class="list-item" id="${id}">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <strong>Fee Group ${feeGroupIndex}</strong>
      <button type="button" onclick="removeEl('${id}')">Remove</button>
    </div>
    <div style="margin-top:8px">
      <input type="text" name="fee_group_name[]" placeholder="Group name (e.g., Admission)" required>
    </div>
    <div style="margin-top:8px">
      <input type="number" step="0.01" name="fee_group_total[]" placeholder="Total amount for group" required>
    </div>
    <div style="margin-top:8px">
      <div id="items_${feeGroupIndex}"></div>
      <button type="button" onclick="addFeeItem(${feeGroupIndex})">+ Add Fee Item</button>
    </div>
  </div>`;
  document.getElementById('feeGroupsContainer').insertAdjacentHTML('beforeend', html);
}

function addFeeItem(groupId){
  const container = document.getElementById('items_'+groupId);
  const idx = Date.now();
  const html = `
    <div style="display:flex;gap:8px;margin-top:8px">
      <input type="text" name="fee_item_name_${groupId}[]" placeholder="Item name (eg: security fee)">
      <input type="number" step="0.01" name="fee_item_amount_${groupId}[]" placeholder="Amount">
      <button type="button" onclick="this.parentNode.remove()">Remove</button>
    </div>`;
  container.insertAdjacentHTML('beforeend', html);
}

function removeEl(id){
  const el = document.getElementById(id);
  if(el) el.remove();
}
</script>
</body>
</html>

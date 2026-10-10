<?php
// Presentation: Deleting Data in MySQL with PHP
// Run: put in htdocs/Latihanphp/ -> http://localhost/Latihanphp/index.php

// All slide content lives in this array. Edit it to change the slides.
$slides = [
  ['type'=>'cover', 'tag'=>'PHP + MySQL · CRUD', 'title'=>'Deleting Data in MySQL with PHP',
   'sub'=>'A step-by-step guide using mysqli'],

  ['type'=>'step', 'icon'=>'🗑️', 'tag'=>'Concept', 'title'=>'The DELETE statement',
   'code'=>"DELETE FROM table_name\nWHERE condition;",
   'points'=>['DELETE FROM chooses the table', 'WHERE chooses which row(s) to remove', 'Deleted rows cannot be recovered']],

  ['type'=>'step', 'icon'=>'🔌', 'tag'=>'Step 1', 'title'=>'Connect to the database',
   'code'=>"\$hostname     = \"localhost\";\n\$username     = \"root\";\n\$password     = \"\";\n\$databaseName = \"latihanphp\";\n\n\$connection = new mysqli(\$hostname, \$username, \$password, \$databaseName);\n\nif (\$connection->connect_error) {\n    die(\"Connection failed: \" . \$connection->connect_error);\n}",
   'points'=>['Always check the connection before running a query']],

  ['type'=>'step', 'icon'=>'✍️', 'tag'=>'Step 2', 'title'=>'Write the query and run it',
   'code'=>"\$sql = \"DELETE FROM `latihanphp`.`tabel_hero_mage` WHERE id = 5\";\n\nif (\$connection->query(\$sql) === TRUE) {\n    echo \"Record deleted successfully\";\n} else {\n    echo \"Error: \" . \$sql . \"<br>\" . \$connection->error;\n}",
   'points'=>['query() returns TRUE when the SQL runs without errors']],

  ['type'=>'demo', 'icon'=>'🎮', 'tag'=>'Try it', 'title'=>'Live demo: DELETE with and without WHERE'],

  ['type'=>'step', 'icon'=>'🛡️', 'tag'=>'Safety', 'title'=>'Safer: prepared statements',
   'code'=>"\$id = 5;\n\$stmt = \$connection->prepare(\"DELETE FROM tabel_hero_mage WHERE id = ?\");\n\$stmt->bind_param(\"i\", \$id);\n\$stmt->execute();\n\necho \$stmt->affected_rows . \" row(s) deleted\";",
   'points'=>['Use this when the id comes from a URL or form', 'The ? placeholder blocks SQL injection']],

  ['type'=>'quiz', 'icon'=>'🧠', 'tag'=>'Quiz', 'title'=>'Check your understanding',
   'questions'=>[
     ['q'=>'What happens if you run DELETE FROM tabel_hero_mage; without WHERE?',
      'a'=>['Nothing, MySQL asks for confirmation','Only the first row is deleted','Every row in the table is deleted'], 'ok'=>2],
     ['q'=>'Which method tells you how many rows were deleted?',
      'a'=>['affected_rows','connect_error','bind_param'], 'ok'=>0]]],

  ['type'=>'recap', 'icon'=>'✅', 'tag'=>'Recap', 'title'=>'What we learned',
   'cards'=>[['🔌','Connect','Use mysqli and check for errors'], ['✍️','Query','DELETE FROM ... WHERE, run with query()'], ['🛡️','Stay safe','Never skip WHERE, prefer prepared statements']]],
];

function e(string $t): string { return htmlspecialchars($t, ENT_QUOTES, 'UTF-8'); }

// Escape first, then color the main keywords.
function hl(string $code): string {
  return preg_replace('/\b(DELETE FROM|WHERE|prepare|bind_param|execute|query|mysqli|die)\b/', '<b class="kw">$1</b>', e($code));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Deleting Data in MySQL with PHP</title>
<style>
:root{--blue:#2563eb;--orange:#f97316;--ink:#1e293b;--mute:#64748b;--bg:#f5f8ff}
*{box-sizing:border-box;margin:0;padding:0}
body{min-height:100vh;background:var(--bg);color:var(--ink);font-family:"Segoe UI",Arial,sans-serif;overflow-x:hidden;position:relative}
body::before,body::after{content:"";position:fixed;border-radius:50%;z-index:0}
body::before{width:420px;height:420px;background:#dbe7ff;top:-140px;right:-120px}
body::after{width:300px;height:300px;background:#ffe8d6;bottom:-110px;left:-90px}
.bar{position:fixed;top:0;left:0;height:6px;background:linear-gradient(90deg,var(--blue),var(--orange));width:0;transition:width .4s;z-index:5}
.deck{position:relative;z-index:1;min-height:100vh}
.slide{display:none;min-height:100vh;width:min(1100px,92%);margin:0 auto;padding:48px 0 110px;flex-direction:column;justify-content:center;gap:24px}
.slide.active{display:flex;animation:in .45s ease}
@keyframes in{from{opacity:0;transform:translateX(40px)}to{opacity:1;transform:none}}
.tag{align-self:flex-start;background:var(--blue);color:#fff;padding:6px 16px;border-radius:99px;font-weight:700;font-size:.9rem}
h1{font-size:clamp(2.4rem,6vw,4.4rem);line-height:1.1;color:var(--blue)}
h2{font-size:clamp(1.7rem,3.6vw,2.7rem)}
h2 .ic{margin-right:10px}
.sub{font-size:1.5rem;color:var(--mute)}
.big{font-size:6rem;animation:float 3s ease-in-out infinite}
@keyframes float{50%{transform:translateY(-14px)}}
.code{position:relative;background:#fff;border:1px solid #dbe3f0;border-left:6px solid var(--blue);border-radius:14px;padding:22px 26px;box-shadow:0 6px 18px #2563eb14}
.code pre{font:1rem/1.65 Consolas,"Courier New",monospace;overflow-x:auto;color:#0f172a}
.kw{color:var(--orange)}
.copy{position:absolute;top:10px;right:10px;border:0;background:#eef3ff;color:var(--blue);padding:6px 12px;border-radius:8px;cursor:pointer;font-weight:600}
.pts{list-style:none;display:flex;flex-direction:column;gap:10px;font-size:1.3rem}
.pts li{background:#fff;border-radius:12px;padding:12px 18px;box-shadow:0 2px 8px #0000000d}
.pts li::before{content:"✔ ";color:var(--orange)}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px}
.card{background:#fff;border-radius:18px;padding:28px;box-shadow:0 8px 22px #2563eb18;transition:transform .2s}
.card:hover{transform:translateY(-6px)}
.card .e{font-size:2.6rem}.card h3{margin:8px 0;color:var(--blue)}
.demo{display:grid;grid-template-columns:1.2fr 1fr;gap:22px}
@media(max-width:800px){.demo{grid-template-columns:1fr}}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 6px 18px #2563eb14}
th{background:var(--blue);color:#fff;text-align:left}th,td{padding:10px 14px}
tr{transition:all .35s}tr.gone{opacity:0;transform:translateX(60px)}
tbody tr:nth-child(even){background:#f5f8ff}
.ctl{display:flex;flex-direction:column;gap:12px}
.ctl label{font-weight:600}
.ctl input{width:90px;padding:8px;border:2px solid #cbd5e1;border-radius:8px;font-size:1.1rem}
.sql{background:#0f172a;color:#e2e8f0;padding:12px 16px;border-radius:10px;font:.95rem Consolas,monospace}
.btn{border:0;border-radius:10px;padding:12px 16px;font-size:1rem;font-weight:700;cursor:pointer;color:#fff;transition:transform .15s}
.btn:hover{transform:scale(1.03)}.ok{background:var(--blue)}.bad{background:#dc2626}.rs{background:#64748b}
.msg{min-height:48px;padding:10px 14px;border-radius:10px;background:#fff;border:1px dashed #94a3b8}
.q{background:#fff;border-radius:16px;padding:22px;box-shadow:0 6px 18px #2563eb14}
.q p{font-weight:700;font-size:1.2rem;margin-bottom:12px}
.opt{display:block;width:100%;text-align:left;margin-top:8px;padding:12px 16px;border:2px solid #dbe3f0;background:#fff;border-radius:10px;font-size:1.05rem;cursor:pointer}
.opt:hover{border-color:var(--blue)}.opt.right{background:#dcfce7;border-color:#16a34a}.opt.wrong{background:#fee2e2;border-color:#dc2626}
nav{position:fixed;bottom:0;left:0;right:0;z-index:5;display:flex;justify-content:center;align-items:center;gap:18px;padding:14px;background:#ffffffd9;backdrop-filter:blur(6px)}
nav button{border:0;background:var(--blue);color:#fff;padding:10px 22px;border-radius:10px;font-weight:700;cursor:pointer}
nav button:disabled{opacity:.3;cursor:default}
.dots{display:flex;gap:8px}.dots i{width:12px;height:12px;border-radius:50%;background:#cbd5e1;cursor:pointer;transition:all .2s}
.dots i.on{background:var(--orange);transform:scale(1.4)}
</style>
</head>
<body>
<div class="bar" id="bar"></div>
<div class="deck">
<?php foreach ($slides as $s): ?>
  <section class="slide">
  <?php if ($s['type'] === 'cover'): ?>
    <div class="big">🗄️</div>
    <span class="tag"><?= e($s['tag']) ?></span>
    <h1><?= e($s['title']) ?></h1>
    <p class="sub"><?= e($s['sub']) ?></p>

  <?php else: ?>
    <span class="tag"><?= e($s['tag']) ?></span>
    <h2><span class="ic"><?= $s['icon'] ?></span><?= e($s['title']) ?></h2>

    <?php if ($s['type'] === 'step'): ?>
      <div class="code"><button class="copy">Copy</button><pre><?= hl($s['code']) ?></pre></div>
      <ul class="pts"><?php foreach ($s['points'] as $p): ?><li><?= e($p) ?></li><?php endforeach; ?></ul>

    <?php elseif ($s['type'] === 'demo'): ?>
      <div class="demo">
        <table><thead><tr><th>id</th><th>Nama_Hero</th><th>Tipe_Hero</th><th>Damage</th></tr></thead><tbody id="rows"></tbody></table>
        <div class="ctl">
          <label>id to delete: <input type="number" id="did" value="3" min="1"></label>
          <div class="sql" id="sql"></div>
          <button class="btn ok" id="runw">▶ Run DELETE with WHERE</button>
          <button class="btn bad" id="runn">⚠ Run DELETE without WHERE</button>
          <button class="btn rs" id="reset">↺ Reset table</button>
          <div class="msg" id="msg">Press a button to run the query.</div>
        </div>
      </div>

    <?php elseif ($s['type'] === 'quiz'): ?>
      <?php foreach ($s['questions'] as $q): ?>
        <div class="q"><p><?= e($q['q']) ?></p>
          <?php foreach ($q['a'] as $k => $a): ?>
            <button class="opt" data-ok="<?= $k === $q['ok'] ? 1 : 0 ?>"><?= e($a) ?></button>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>

    <?php elseif ($s['type'] === 'recap'): ?>
      <div class="cards"><?php foreach ($s['cards'] as $c): ?>
        <div class="card"><div class="e"><?= $c[0] ?></div><h3><?= e($c[1]) ?></h3><p><?= e($c[2]) ?></p></div>
      <?php endforeach; ?></div>
    <?php endif; ?>
  <?php endif; ?>
  </section>
<?php endforeach; ?>
</div>

<nav>
  <button id="prev">← Previous</button>
  <div class="dots" id="dots"></div>
  <button id="next">Next →</button>
  <button id="fullscreen">⛶ Fullscreen</button>
</nav>

<script>
// ---- Slide navigation (keyboard, buttons, dots, URL hash) ----
const slides = [...document.querySelectorAll('.slide')];
const dots = document.getElementById('dots');
let cur = 0;
slides.forEach((_, k) => { const d = document.createElement('i'); d.onclick = () => go(k); dots.appendChild(d); });
function go(n) {
  cur = Math.max(0, Math.min(slides.length - 1, n));
  slides.forEach((s, k) => s.classList.toggle('active', k === cur));
  [...dots.children].forEach((d, k) => d.classList.toggle('on', k === cur));
  document.getElementById('bar').style.width = ((cur + 1) / slides.length * 100) + '%';
  document.getElementById('prev').disabled = cur === 0;
  document.getElementById('next').disabled = cur === slides.length - 1;
  location.hash = cur + 1;
}
document.getElementById('prev').onclick = () => go(cur - 1);
document.getElementById('next').onclick = () => go(cur + 1);
document.addEventListener('keydown', e => {
  if (e.target.tagName === 'INPUT') return;
  if (e.key === 'ArrowRight') go(cur + 1);
  if (e.key === 'ArrowLeft') go(cur - 1);
});
go((parseInt(location.hash.slice(1)) || 1) - 1);



/* ---- Fullscreen ---- */
const fullscreenBtn = document.getElementById('fullscreen');

function updateFullscreenButton() {
  const isFullscreen = !!document.fullscreenElement;

  fullscreenBtn.textContent = isFullscreen
    ? '⛶ Exit Fullscreen'
    : '⛶ Fullscreen';
}

fullscreenBtn.addEventListener('click', async () => {
  try {
    if (document.fullscreenElement) {
      await document.exitFullscreen();
    } else {
      await document.documentElement.requestFullscreen();
    }
  } catch (error) {
    console.error('Fullscreen error:', error);
  }
});

document.addEventListener(
  'fullscreenchange',
  updateFullscreenButton
);

updateFullscreenButton();

// ---- Copy buttons ----
document.querySelectorAll('.copy').forEach(b => b.onclick = () => {
  navigator.clipboard.writeText(b.nextElementSibling.textContent);
  b.textContent = 'Copied!'; setTimeout(() => b.textContent = 'Copy', 1200);
});

// ---- Quiz ----
document.querySelectorAll('.q').forEach(q => q.querySelectorAll('.opt').forEach(o => o.onclick = () => {
  q.querySelectorAll('.opt').forEach(x => x.disabled = true);
  o.classList.add(o.dataset.ok === '1' ? 'right' : 'wrong');
  q.querySelector('[data-ok="1"]').classList.add('right');
}));

// ---- Live demo (simulated table, no database needed) ----
const start = [[1,'Zhuxin','Control',60],[2,'Gusion','Burst',120],[3,'Vexana','Burst',80],[4,'Kimmy','Scaling',60],[6,'Lylia','Burst',100],[7,'Harley','Burst',90]];
let data = start.map(r => r.slice());
const rows = document.getElementById('rows'), msg = document.getElementById('msg'), did = document.getElementById('did'), sql = document.getElementById('sql');
function draw() { rows.innerHTML = data.map(r => `<tr data-id="${r[0]}">${r.map(c => `<td>${c}</td>`).join('')}</tr>`).join(''); }
function preview() { sql.textContent = `DELETE FROM tabel_hero_mage WHERE id = ${did.value || '?'};`; }
function remove(ids) {
  ids.forEach(id => { const tr = rows.querySelector(`tr[data-id="${id}"]`); if (tr) tr.classList.add('gone'); });
  setTimeout(() => { data = data.filter(r => !ids.includes(r[0])); draw(); }, 350);
}
did.oninput = preview; preview(); draw();
document.getElementById('runw').onclick = () => {
  const id = parseInt(did.value), hit = data.some(r => r[0] === id);
  if (hit) remove([id]);
  msg.textContent = hit ? '1 row(s) deleted. Only id ' + id + ' is gone.' : '0 row(s) deleted. No row has id ' + id + '.';
};
document.getElementById('runn').onclick = () => {
  sql.textContent = 'DELETE FROM tabel_hero_mage;';
  remove(data.map(r => r[0]));
  msg.textContent = '⚠ ' + data.length + ' row(s) deleted. Without WHERE, the whole table is emptied!';
  setTimeout(preview, 1500);
};
document.getElementById('reset').onclick = () => { data = start.map(r => r.slice()); draw(); preview(); msg.textContent = 'Table reset.'; };
</script>
</body>
</html>
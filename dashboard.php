<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Arguiouane Abdelhakim — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<style>
    
/* ═══════════════════════════════════════════
   RESET & ROOT
═══════════════════════════════════════════ */
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --bg:#04080f;
  --s1:#080e1a;
  --s2:#0d1526;
  --s3:#111e35;
  --border:rgba(255,255,255,.06);
  --border-h:rgba(99,102,241,.35);
  --p:#6366f1;
  --p2:#818cf8;
  --p3:#4f46e5;
  --accent:#06b6d4;
  --green:#10b981;
  --amber:#f59e0b;
  --t1:#f0f4ff;
  --t2:#94a3b8;
  --t3:#475569;
  --font-h:'Syne',sans-serif;
  --font-b:'DM Sans',sans-serif;
  --r:14px;
  --r-sm:8px;
}

html{scroll-behavior:smooth}
body{
  font-family:var(--font-b);
  background:var(--bg);
  color:var(--t1);
  min-height:100vh;
  overflow-x:hidden;
}

/* ═══════════════════════════════════════════
   CANVAS PARTICLES
═══════════════════════════════════════════ */
#particles{
  position:fixed;top:0;left:0;
  width:100%;height:100%;
  pointer-events:none;z-index:0;
  opacity:.4;
}

/* ═══════════════════════════════════════════
   AMBIENT GLOWS
═══════════════════════════════════════════ */
.glow-orb{
  position:fixed;border-radius:50%;
  pointer-events:none;z-index:0;
  filter:blur(80px);
  animation:orbFloat 8s ease-in-out infinite;
}
.glow-orb.a{
  width:500px;height:500px;
  background:radial-gradient(circle,rgba(99,102,241,.18),transparent 70%);
  top:-150px;left:-150px;
}
.glow-orb.b{
  width:350px;height:350px;
  background:radial-gradient(circle,rgba(6,182,212,.12),transparent 70%);
  bottom:-100px;right:-100px;
  animation-delay:-4s;
}
.glow-orb.c{
  width:250px;height:250px;
  background:radial-gradient(circle,rgba(79,70,229,.1),transparent 70%);
  top:50%;left:50%;
  animation-delay:-2s;
}
@keyframes orbFloat{
  0%,100%{transform:translate(0,0) scale(1)}
  33%{transform:translate(30px,-20px) scale(1.05)}
  66%{transform:translate(-20px,30px) scale(.95)}
}

/* ═══════════════════════════════════════════
   LAYOUT
═══════════════════════════════════════════ */
.layout{
  display:flex;min-height:100vh;
  position:relative;z-index:1;
}

/* ═══════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════ */
.sidebar{
  width:260px;flex-shrink:0;
  background:rgba(8,14,26,.85);
  backdrop-filter:blur(24px);
  border-right:1px solid var(--border);
  display:flex;flex-direction:column;
  padding:28px 18px;gap:0;
  position:sticky;top:0;height:100vh;overflow-y:auto;
  animation:slideInLeft .6s cubic-bezier(.16,1,.3,1) both;
}
@keyframes slideInLeft{
  from{transform:translateX(-100%);opacity:0}
  to{transform:translateX(0);opacity:1}
}

/* Logo */
.sb-brand{
  display:flex;align-items:center;gap:10px;
  margin-bottom:28px;
}
.sb-brand-icon{
  width:36px;height:36px;border-radius:10px;
  background:linear-gradient(135deg,var(--p3),#7c3aed);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-weight:800;font-size:15px;color:#fff;
  box-shadow:0 0 16px rgba(99,102,241,.4);
  animation:iconPulse 3s ease-in-out infinite;
}
@keyframes iconPulse{
  0%,100%{box-shadow:0 0 16px rgba(99,102,241,.4)}
  50%{box-shadow:0 0 28px rgba(99,102,241,.7)}
}
.sb-brand-name{
  font-family:var(--font-h);font-weight:700;font-size:15px;
  letter-spacing:-.3px;
}

/* Avatar */
.sb-avatar-wrap{
  text-align:center;
  padding:20px 0 24px;
  border-bottom:1px solid var(--border);
  margin-bottom:24px;
}
.avatar-ring{
  width:82px;height:82px;border-radius:50%;
  background:linear-gradient(135deg,var(--p3),#7c3aed,var(--accent));
  padding:2px;margin:0 auto 14px;
  box-shadow:0 0 28px rgba(99,102,241,.35);
  animation:ringRotate 6s linear infinite;
}
@keyframes ringRotate{
  from{filter:hue-rotate(0deg)}
  to{filter:hue-rotate(360deg)}
}
.avatar-inner{
  width:100%;height:100%;border-radius:50%;
  background:var(--s2);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:26px;font-weight:800;
  color:var(--p2);
}
.sb-name{
  font-family:var(--font-h);font-size:14px;font-weight:700;
  letter-spacing:-.2px;margin-bottom:4px;
}
.sb-role{font-size:11px;color:var(--t2);margin-bottom:10px;line-height:1.5}
.online-badge{
  display:inline-flex;align-items:center;gap:5px;
  font-size:10px;font-weight:600;color:var(--green);
  background:rgba(16,185,129,.1);
  border:1px solid rgba(16,185,129,.25);
  border-radius:20px;padding:3px 10px;
}
.online-dot{
  width:6px;height:6px;border-radius:50%;
  background:var(--green);
  animation:blink 2s ease-in-out infinite;
}
@keyframes blink{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.7)}}

/* Nav */
.nav-label{
  font-size:9px;font-weight:700;letter-spacing:2px;
  text-transform:uppercase;color:var(--t3);
  margin-bottom:8px;padding:0 6px;
}
.nav-item{
  display:flex;align-items:center;gap:11px;
  padding:10px 12px;border-radius:10px;
  font-size:12.5px;font-weight:500;
  color:var(--t2);cursor:pointer;
  transition:all .25s cubic-bezier(.16,1,.3,1);
  margin-bottom:3px;border:1px solid transparent;
  position:relative;overflow:hidden;
}
.nav-item::before{
  content:'';
  position:absolute;left:0;top:0;
  width:2px;height:100%;
  background:var(--p2);
  transform:scaleY(0);
  transition:transform .25s;
  border-radius:0 2px 2px 0;
}
.nav-item:hover{
  background:rgba(99,102,241,.08);
  color:var(--t1);
  border-color:rgba(99,102,241,.15);
}
.nav-item.active{
  background:rgba(99,102,241,.14);
  color:var(--p2);
  border-color:rgba(99,102,241,.25);
}
.nav-item.active::before{transform:scaleY(1)}
.nav-icon{
  width:32px;height:32px;border-radius:8px;
  display:flex;align-items:center;justify-content:center;
  font-size:13px;background:rgba(255,255,255,.04);
  transition:all .25s;flex-shrink:0;
}
.nav-item.active .nav-icon{
  background:rgba(99,102,241,.2);color:var(--p2);
}
.nav-item:hover .nav-icon{background:rgba(99,102,241,.1)}

/* Sidebar footer */
.sb-footer{margin-top:auto;padding-top:20px;border-top:1px solid var(--border)}
.dl-card{
  background:rgba(99,102,241,.07);
  border:1px solid rgba(99,102,241,.18);
  border-radius:12px;padding:14px;text-align:center;
}
.dl-card p{font-size:11px;color:var(--t2);margin-bottom:8px}
.dl-btn{
  display:inline-flex;align-items:center;gap:6px;
  background:linear-gradient(135deg,var(--p3),#7c3aed);
  color:#fff;border:none;border-radius:8px;
  padding:7px 16px;font-size:11px;font-weight:600;
  cursor:pointer;transition:all .2s;
  font-family:var(--font-b);
}
.dl-btn:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(99,102,241,.4)}

/* ═══════════════════════════════════════════
   MAIN
═══════════════════════════════════════════ */
.main{
  flex:1;padding:32px 36px;
  overflow-y:auto;
}

/* Topbar */
.topbar{
  display:flex;align-items:flex-start;justify-content:space-between;
  margin-bottom:32px;
  animation:fadeDown .5s .2s both;
}
@keyframes fadeDown{
  from{opacity:0;transform:translateY(-16px)}
  to{opacity:1;transform:translateY(0)}
}
.topbar-title{
  font-family:var(--font-h);font-size:26px;font-weight:800;
  letter-spacing:-.5px;margin-bottom:4px;
}
.topbar-sub{font-size:12.5px;color:var(--t2)}
.topbar-actions{display:flex;gap:10px;flex-shrink:0}
.btn-ghost{
  display:inline-flex;align-items:center;gap:7px;
  padding:8px 16px;border-radius:9px;
  font-size:12px;font-weight:600;
  border:1px solid rgba(255,255,255,.1);
  background:transparent;color:var(--t2);
  cursor:pointer;transition:all .2s;
  font-family:var(--font-b);
}
.btn-ghost:hover{background:rgba(255,255,255,.05);color:var(--t1);border-color:rgba(255,255,255,.2)}
.btn-solid{
  display:inline-flex;align-items:center;gap:7px;
  padding:8px 16px;border-radius:9px;
  font-size:12px;font-weight:600;
  border:none;background:var(--p3);color:#fff;
  cursor:pointer;transition:all .2s;
  font-family:var(--font-b);
}
.btn-solid:hover{background:var(--p);transform:translateY(-1px);box-shadow:0 6px 20px rgba(99,102,241,.35)}

/* ═══════════════════════════════════════════
   TAB CONTENT
═══════════════════════════════════════════ */
.tab-content{display:none;animation:tabIn .4s cubic-bezier(.16,1,.3,1) both}
.tab-content.active{display:block}
@keyframes tabIn{
  from{opacity:0;transform:translateY(12px)}
  to{opacity:1;transform:translateY(0)}
}

/* ═══════════════════════════════════════════
   STAT CARDS
═══════════════════════════════════════════ */
.stats-grid{
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:14px;margin-bottom:22px;
}
.stat-card{
  background:rgba(13,21,38,.7);
  border:1px solid var(--border);
  border-radius:var(--r);padding:20px;
  backdrop-filter:blur(12px);
  transition:all .3s cubic-bezier(.16,1,.3,1);
  cursor:default;
  animation:cardIn .5s both;
  position:relative;overflow:hidden;
}
.stat-card::after{
  content:'';position:absolute;
  inset:0;border-radius:var(--r);
  background:linear-gradient(135deg,rgba(99,102,241,.04),transparent);
  opacity:0;transition:opacity .3s;
}
.stat-card:hover{
  transform:translateY(-4px);
  border-color:var(--border-h);
  box-shadow:0 16px 40px rgba(0,0,0,.3),0 0 0 1px rgba(99,102,241,.15);
}
.stat-card:hover::after{opacity:1}
@keyframes cardIn{
  from{opacity:0;transform:translateY(20px)}
  to{opacity:1;transform:translateY(0)}
}
.stat-icon-wrap{
  width:40px;height:40px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-size:16px;margin-bottom:14px;
}
.stat-val{
  font-family:var(--font-h);font-size:28px;
  font-weight:800;letter-spacing:-1.5px;
  margin-bottom:2px;
}
.stat-lbl{font-size:11px;color:var(--t2);font-weight:500}

/* ═══════════════════════════════════════════
   CARDS
═══════════════════════════════════════════ */
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px}
.grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:16px}
.card{
  background:rgba(13,21,38,.65);
  border:1px solid var(--border);
  border-radius:var(--r);padding:22px;
  backdrop-filter:blur(12px);
  transition:border-color .3s;
  animation:cardIn .5s .1s both;
}
.card:hover{border-color:rgba(99,102,241,.2)}
.card-head{
  display:flex;align-items:center;gap:8px;
  font-family:var(--font-h);font-size:13px;font-weight:700;
  letter-spacing:-.2px;margin-bottom:18px;color:var(--t1);
}
.card-head-dot{
  width:8px;height:8px;border-radius:50%;
  background:var(--p);
  box-shadow:0 0 8px var(--p);
  animation:dotPulse 2s ease-in-out infinite;
}
@keyframes dotPulse{0%,100%{box-shadow:0 0 8px var(--p)}50%{box-shadow:0 0 14px var(--p2)}}

/* ═══════════════════════════════════════════
   TAGS
═══════════════════════════════════════════ */
.tag{
  display:inline-flex;align-items:center;gap:5px;
  padding:4px 11px;border-radius:20px;
  font-size:10.5px;font-weight:600;
  margin:3px 3px 3px 0;
  background:rgba(99,102,241,.1);
  color:var(--p2);
  border:1px solid rgba(99,102,241,.2);
  transition:all .2s;
}
.tag:hover{background:rgba(99,102,241,.2);border-color:rgba(99,102,241,.4)}
.tag.green{background:rgba(16,185,129,.08);color:#34d399;border-color:rgba(16,185,129,.22)}
.tag.cyan{background:rgba(6,182,212,.08);color:#22d3ee;border-color:rgba(6,182,212,.22)}
.tag.amber{background:rgba(245,158,11,.08);color:#fbbf24;border-color:rgba(245,158,11,.22)}

/* ═══════════════════════════════════════════
   TIMELINE
═══════════════════════════════════════════ */
.tl-item{
  position:relative;padding-left:22px;
  margin-bottom:20px;
}
.tl-item::before{
  content:'';position:absolute;left:2px;top:6px;
  width:8px;height:8px;border-radius:50%;
  background:var(--p);
  box-shadow:0 0 10px rgba(99,102,241,.7);
  z-index:1;
}
.tl-item::after{
  content:'';position:absolute;left:5px;top:14px;
  width:2px;height:calc(100% + 6px);
  background:linear-gradient(to bottom,rgba(99,102,241,.4),transparent);
}
.tl-item:last-child::after{display:none}
.tl-date{
  font-size:10px;font-weight:700;color:var(--p2);
  margin-bottom:4px;letter-spacing:.5px;
  text-transform:uppercase;
}
.tl-title{
  font-family:var(--font-h);font-size:13px;font-weight:700;
  margin-bottom:3px;
}
.tl-sub{font-size:11.5px;color:var(--t2);line-height:1.6}

/* ═══════════════════════════════════════════
   SKILL BARS
═══════════════════════════════════════════ */
.skill-row{margin-bottom:14px}
.skill-top{
  display:flex;justify-content:space-between;
  font-size:12px;color:var(--t2);margin-bottom:6px;font-weight:500;
}
.skill-pct{color:var(--p2);font-weight:700}
.skill-track{
  height:5px;background:rgba(255,255,255,.05);
  border-radius:5px;overflow:hidden;
}
.skill-fill{
  height:100%;border-radius:5px;
  background:linear-gradient(90deg,var(--p3),var(--p2));
  width:0;transition:width 1.2s cubic-bezier(.16,1,.3,1);
  position:relative;
}
.skill-fill::after{
  content:'';
  position:absolute;right:0;top:0;
  width:6px;height:100%;
  background:rgba(255,255,255,.4);
  border-radius:5px;
  animation:shimmer 2s ease-in-out infinite;
}
@keyframes shimmer{0%,100%{opacity:.4}50%{opacity:1}}

/* ═══════════════════════════════════════════
   LANGUE DOTS
═══════════════════════════════════════════ */
.lang-grid{
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:14px;
}
.lang-item{text-align:center;padding:16px 8px;
  background:rgba(255,255,255,.02);
  border:1px solid var(--border);border-radius:12px;
  transition:all .3s;
}
.lang-item:hover{border-color:rgba(99,102,241,.25);background:rgba(99,102,241,.04)}
.lang-flag-icon{
  width:42px;height:42px;border-radius:50%;
  background:rgba(99,102,241,.1);
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 10px;font-size:20px;
}
.lang-name{
  font-family:var(--font-h);font-size:12px;
  font-weight:700;margin-bottom:3px;
}
.lang-level{font-size:10px;color:var(--t2);margin-bottom:8px}
.lang-dots{display:flex;justify-content:center;gap:4px}
.lang-dot{
  width:7px;height:7px;border-radius:50%;
  background:rgba(255,255,255,.1);
  transition:all .3s;
}
.lang-dot.on{
  background:var(--p);
  box-shadow:0 0 6px rgba(99,102,241,.6);
}

/* ═══════════════════════════════════════════
   EXPERIENCE
═══════════════════════════════════════════ */
.exp-card{
  background:rgba(13,21,38,.65);
  border:1px solid var(--border);
  border-radius:var(--r);padding:24px;
  backdrop-filter:blur(12px);
  position:relative;overflow:hidden;
  animation:cardIn .4s both;
}
.exp-card::before{
  content:'';position:absolute;
  top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,var(--p3),var(--accent));
}
.exp-header{
  display:flex;align-items:flex-start;
  justify-content:space-between;margin-bottom:14px;
}
.exp-role{
  font-family:var(--font-h);font-size:18px;
  font-weight:800;letter-spacing:-.4px;margin-bottom:4px;
}
.exp-company{font-size:13.5px;color:var(--p2);font-weight:600}
.exp-meta{
  display:flex;align-items:center;gap:14px;
  font-size:11px;color:var(--t3);
  margin-bottom:18px;flex-wrap:wrap;
}
.exp-meta span{display:flex;align-items:center;gap:5px}
.exp-divider{
  border:none;border-top:1px solid var(--border);
  margin-bottom:16px;
}
.task-row{
  display:flex;align-items:flex-start;gap:10px;
  font-size:12.5px;color:var(--t2);
  margin-bottom:10px;line-height:1.6;
}
.task-icon{
  width:20px;height:20px;border-radius:6px;
  background:rgba(99,102,241,.12);
  display:flex;align-items:center;justify-content:center;
  font-size:10px;color:var(--p2);
  flex-shrink:0;margin-top:2px;
}

/* ═══════════════════════════════════════════
   PROJECTS
═══════════════════════════════════════════ */
.proj-card{
  background:rgba(8,14,26,.8);
  border:1px solid var(--border);
  border-radius:var(--r);padding:22px;
  transition:all .3s cubic-bezier(.16,1,.3,1);
  position:relative;overflow:hidden;
}
.proj-card::before{
  content:'';position:absolute;
  inset:0;border-radius:var(--r);
  background:radial-gradient(800px at var(--mx,50%) var(--my,50%),rgba(99,102,241,.05),transparent 40%);
  opacity:0;transition:opacity .3s;
}
.proj-card:hover{
  border-color:rgba(99,102,241,.3);
  transform:translateY(-3px);
  box-shadow:0 20px 48px rgba(0,0,0,.4);
}
.proj-card:hover::before{opacity:1}
.proj-top{
  display:flex;align-items:flex-start;
  justify-content:space-between;margin-bottom:10px;
}
.proj-title{
  font-family:var(--font-h);font-size:15px;
  font-weight:700;letter-spacing:-.3px;margin-bottom:4px;
}
.proj-subtitle{font-size:10.5px;color:var(--t3)}
.proj-desc{
  font-size:12.5px;color:var(--t2);
  line-height:1.8;margin-bottom:14px;
}
.proj-icon-wrap{
  width:42px;height:42px;border-radius:10px;
  background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(6,182,212,.1));
  border:1px solid rgba(99,102,241,.2);
  display:flex;align-items:center;justify-content:center;
  font-size:16px;color:var(--p2);flex-shrink:0;
}

/* ═══════════════════════════════════════════
   SOFT SKILLS
═══════════════════════════════════════════ */
.soft-grid{
  display:grid;grid-template-columns:repeat(3,1fr);gap:10px;
}
.soft-item{
  background:rgba(99,102,241,.05);
  border:1px solid rgba(99,102,241,.1);
  border-radius:10px;padding:12px 14px;
  font-size:12px;font-weight:600;
  text-align:center;color:var(--t2);
  transition:all .25s;
  display:flex;align-items:center;justify-content:center;gap:7px;
}
.soft-item:hover{
  background:rgba(99,102,241,.12);
  border-color:rgba(99,102,241,.25);
  color:var(--p2);transform:scale(1.02);
}

/* ═══════════════════════════════════════════
   CONTACT
═══════════════════════════════════════════ */
.contact-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:10px;
}
.contact-mini{
  background:rgba(8,14,26,.7);
  border:1px solid var(--border);
  border-radius:10px;padding:14px;
  transition:all .25s;
}
.contact-mini:hover{border-color:rgba(99,102,241,.25)}
.contact-mini-label{
  font-size:9.5px;color:var(--t3);
  font-weight:700;text-transform:uppercase;
  letter-spacing:1px;margin-bottom:5px;
  display:flex;align-items:center;gap:5px;
}
.contact-mini-val{
  font-size:11.5px;font-weight:500;
  word-break:break-all;color:var(--t1);
}

/* ═══════════════════════════════════════════
   HOBBY + PERMIS
═══════════════════════════════════════════ */
.hobby-pill{
  display:inline-flex;align-items:center;gap:8px;
  padding:9px 18px;border-radius:12px;
  font-size:12.5px;font-weight:600;
  background:rgba(99,102,241,.07);
  border:1px solid rgba(99,102,241,.14);
  color:var(--t2);margin:5px 7px 5px 0;
  transition:all .2s;
}
.hobby-pill:hover{
  background:rgba(99,102,241,.14);
  color:var(--p2);transform:translateY(-2px);
}
.permis-box{
  display:flex;align-items:center;gap:10px;
  background:rgba(99,102,241,.06);
  border:1px solid rgba(99,102,241,.15);
  border-radius:10px;padding:14px 18px;
  font-size:13px;font-weight:600;color:var(--t1);
}

/* ═══════════════════════════════════════════
   TOOLS CATEGORY
═══════════════════════════════════════════ */
.tool-section{margin-bottom:16px}
.tool-label{
  font-size:9.5px;color:var(--t3);
  font-weight:700;text-transform:uppercase;
  letter-spacing:1.5px;margin-bottom:8px;
  display:flex;align-items:center;gap:6px;
}
.tool-label::after{
  content:'';flex:1;height:1px;
  background:var(--border);
}

/* ═══════════════════════════════════════════
   SCROLLBAR
═══════════════════════════════════════════ */
::-webkit-scrollbar{width:4px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:rgba(99,102,241,.3);border-radius:4px}
::-webkit-scrollbar-thumb:hover{background:rgba(99,102,241,.5)}

/* ═══════════════════════════════════════════
   STAGGER ANIMATIONS
═══════════════════════════════════════════ */
.stagger-1{animation-delay:.05s}
.stagger-2{animation-delay:.1s}
.stagger-3{animation-delay:.15s}
.stagger-4{animation-delay:.2s}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
/* ═══════════════════════════════════════════
   MOBILE BOTTOM NAV
═══════════════════════════════════════════ */
.mobile-nav{
  display:none;
  position:fixed;bottom:0;left:0;right:0;
  background:rgba(8,14,26,.95);
  backdrop-filter:blur(24px);
  border-top:1px solid rgba(99,102,241,.15);
  padding:8px 4px calc(8px + env(safe-area-inset-bottom));
  z-index:100;
  justify-content:space-around;
  align-items:center;
}
.mob-nav-item{
  display:flex;flex-direction:column;align-items:center;gap:4px;
  padding:6px 12px;border-radius:12px;
  font-size:9.5px;font-weight:600;
  color:var(--t3);cursor:pointer;
  transition:all .25s cubic-bezier(.16,1,.3,1);
  min-width:52px;
  border:1px solid transparent;
  background:transparent;
  font-family:var(--font-b);
  position:relative;
}
.mob-nav-item i{
  font-size:17px;transition:all .25s cubic-bezier(.16,1,.3,1);
}
.mob-nav-item.active{
  color:var(--p2);
  background:rgba(99,102,241,.12);
  border-color:rgba(99,102,241,.2);
}
.mob-nav-item.active i{
  transform:translateY(-2px);
  filter:drop-shadow(0 0 6px rgba(99,102,241,.7));
}
.mob-nav-item:active{
  transform:scale(.92);
}
/* active indicator dot */
.mob-nav-item.active::after{
  content:'';
  position:absolute;bottom:4px;
  width:4px;height:4px;border-radius:50%;
  background:var(--p2);
  box-shadow:0 0 6px var(--p2);
}

.avatar-inner{
  width:100%;
  height:100%;
  border-radius:50%;
  background:var(--s2);
  display:flex;
  align-items:center;
  justify-content:center;
  overflow:hidden; /* مهم بزاف */
}

.avatar-inner img{
  width:100%;
  height:100%;
  object-fit:cover; /* باش متتبانش مشدودة */
  border-radius:50%;
}

@media(max-width:900px){
  .sidebar{display:none}
  .mobile-nav{display:flex}
  .main{
    padding:16px 16px calc(80px + env(safe-area-inset-bottom));
  }
  .topbar{flex-direction:column;gap:12px;align-items:flex-start;margin-bottom:20px}
  .topbar-title{font-size:20px}
  .stats-grid{grid-template-columns:repeat(2,1fr);gap:10px}
  .grid-2{grid-template-columns:1fr}
  .lang-grid{grid-template-columns:repeat(2,1fr)}
  .soft-grid{grid-template-columns:repeat(2,1fr)}
  .contact-grid{grid-template-columns:1fr}
  .exp-header{flex-direction:column;gap:10px}
  .proj-top{flex-direction:column;gap:10px}
}
</style>
</head>
<body>

<canvas id="particles"></canvas>
<div class="glow-orb a"></div>
<div class="glow-orb b"></div>
<div class="glow-orb c"></div>

<div class="layout">

  <!-- ══════════════ SIDEBAR ══════════════ -->
  <aside class="sidebar">

    <div class="sb-brand">
      
      <span class="sb-brand-name">My Portfolio</span>
    </div>

    <div class="sb-avatar-wrap">
    <div class="avatar-ring">
  <div class="avatar-inner">
<img src="img/img cv.jpeg" alt="profile">
  </div>
</div>
      <div class="sb-name">Arguiouane Abdelhakim</div>
      <div class="sb-role">Frontend &amp; Backend Developer</div>
      <div>
        <span class="online-badge">
          <span class="online-dot"></span>
          Disponible
        </span>
      </div>
    </div>

    <div style="margin-bottom:24px">
      <div class="nav-label">Navigation</div>
      <div class="nav-item active" onclick="switchTab('overview',this)">
        <div class="nav-icon"><i class="fa-solid fa-house"></i></div>
        Aperçu
      </div>
      <div class="nav-item" onclick="switchTab('skills',this)">
        <div class="nav-icon"><i class="fa-solid fa-bolt"></i></div>
        Compétences
      </div>
      <div class="nav-item" onclick="switchTab('experience',this)">
        <div class="nav-icon"><i class="fa-solid fa-briefcase"></i></div>
        Expérience
      </div>
      <div class="nav-item" onclick="switchTab('projects',this)">
        <div class="nav-icon"><i class="fa-solid fa-rocket"></i></div>
        Projets
      </div>
      <div class="nav-item" onclick="switchTab('more',this)">
        <div class="nav-icon"><i class="fa-solid fa-sparkles"></i></div>
        Plus
      </div>
    </div>

    <div class="sb-footer">
      <div class="dl-card">
      <a href="cv/CV-Argui.pdf" download class="dl-btn">
  <i class="fa-solid fa-file-arrow-down"></i>
  Download PDF
   </a>
        </button>
      </div>
    </div>
  </aside>

  <!-- ══════════════ MAIN ══════════════ -->
  <main class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div>
        <div class="topbar-title" id="page-title">Aperçu général</div>
        <div class="topbar-sub" id="page-sub">Bienvenue sur mon dashboard interactif</div>
      </div>
      <div class="topbar-actions">
      <a href="contact.php?search=arguiouane.abdelhakim@gmail.com" class="btn-ghost" target="_blank">
   <i class="fa-solid fa-envelope"></i> Contact
</a>
        <button class="btn-solid" onclick="window.open('https://github.com/hakimo-0')">
          <i class="fa-brands fa-github"></i> GitHub
        </button>
      </div>
    </div>

    <!-- ══════ TAB: OVERVIEW ══════ -->
    <div id="tab-overview" class="tab-content active">

      <div class="stats-grid">
        <div class="stat-card stagger-1">
          <div class="stat-icon-wrap" style="background:rgba(99,102,241,.12)">
            <i class="fa-solid fa-briefcase" style="color:#818cf8;font-size:16px"></i>
          </div>
          <div class="stat-val" style="color:#818cf8">1</div>
          <div class="stat-lbl">Stage professionnel</div>
        </div>
        <div class="stat-card stagger-2">
          <div class="stat-icon-wrap" style="background:rgba(16,185,129,.1)">
            <i class="fa-solid fa-rocket" style="color:#34d399;font-size:16px"></i>
          </div>
          <div class="stat-val" style="color:#34d399">1</div>
          <div class="stat-lbl">Projet réalisé</div>
        </div>
        <div class="stat-card stagger-3">
          <div class="stat-icon-wrap" style="background:rgba(245,158,11,.1)">
            <i class="fa-solid fa-earth-africa" style="color:#fbbf24;font-size:16px"></i>
          </div>
          <div class="stat-val" style="color:#fbbf24">4</div>
          <div class="stat-lbl">Langues</div>
        </div>
        <div class="stat-card stagger-4">
          <div class="stat-icon-wrap" style="background:rgba(244,114,182,.1)">
            <i class="fa-solid fa-layer-group" style="color:#f472b6;font-size:16px"></i>
          </div>
          <div class="stat-val" style="color:#f472b6">10+</div>
          <div class="stat-lbl">Technologies</div>
        </div>
      </div>

      <div class="grid-2">
        <div class="card">
          <div class="card-head"><div class="card-head-dot"></div>Profil</div>
          <p style="font-size:12.5px;color:var(--t2);line-height:1.85;margin-bottom:16px">
            Personne curieuse, motivée et avec une bonne compréhension technique. Je m'intéresse particulièrement au développement logiciel, à la programmation et aux nouvelles technologies. J'aime la réflexion logique, la résolution de problèmes et le travail structuré.
          </p>
          <div>
            <span class="tag green"><i class="fa-solid fa-circle-check" style="font-size:9px"></i> Disponible</span>
            <span class="tag"><i class="fa-solid fa-location-dot" style="font-size:9px"></i> Errachidia, Maroc</span>
            <span class="tag"><i class="fa-solid fa-cake-candles" style="font-size:9px"></i> 26.01.2005</span>
          </div>
        </div>
        <div class="card">
          <div class="card-head"><div class="card-head-dot"></div>Formation</div>
          <div class="tl-item">
            <div class="tl-date">Oct 2024 — Actuellement</div>
            <div class="tl-title">Développement informatique</div>
            <div class="tl-sub">ESIAS — Frontend, Backend &amp; Design</div>
          </div>
          <div class="tl-item">
            <div class="tl-date">Juin 2024</div>
            <div class="tl-title">Baccalauréat sciences physiques</div>
            <div class="tl-sub">Lycée Manarat Tafilalt Errachidia</div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-head"><div class="card-head-dot"></div>Langues</div>
        <div class="lang-grid">
          <div class="lang-item">
            <div class="lang-flag-icon"><i class="fa-solid fa-language" style="color:#c0392b"></i></div>
            <div class="lang-name">Arabe</div>
            <div class="lang-level">Maternelle</div>
            <div class="lang-dots">
              <div class="lang-dot on"></div><div class="lang-dot on"></div>
              <div class="lang-dot on"></div><div class="lang-dot on"></div>
              <div class="lang-dot on"></div>
            </div>
          </div>
          <div class="lang-item">
            <div class="lang-flag-icon"><i class="fa-solid fa-language" style="color:#000;background:#ffcc00;border-radius:3px;padding:3px 5px"></i></div>
            <div class="lang-name">Allemand</div>
            <div class="lang-level">B1 — TELC</div>
            <div class="lang-dots">
              <div class="lang-dot on"></div><div class="lang-dot on"></div>
              <div class="lang-dot on"></div><div class="lang-dot"></div>
              <div class="lang-dot"></div>
            </div>
          </div>
          <div class="lang-item">
            <div class="lang-flag-icon"><i class="fa-solid fa-language" ></i></div>
            <div class="lang-name">Anglais</div>
            <div class="lang-level">B1</div>
            <div class="lang-dots">
              <div class="lang-dot on"></div><div class="lang-dot on"></div>
              <div class="lang-dot on"></div><div class="lang-dot"></div>
              <div class="lang-dot"></div>
            </div>
          </div>
          <div class="lang-item">
            <div class="lang-flag-icon"><i class="fa-solid fa-language" style="color:#003189"></i></div>
            <div class="lang-name">Français</div>
            <div class="lang-level">B1</div>
            <div class="lang-dots">
              <div class="lang-dot on"></div><div class="lang-dot on"></div>
              <div class="lang-dot on"></div><div class="lang-dot"></div>
              <div class="lang-dot"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ TAB: SKILLS ══════ -->
    <div id="tab-skills" class="tab-content">
      <div class="grid-2" style="margin-bottom:16px">
        <div class="card">
          <div class="card-head"><div class="card-head-dot"></div>Langages de programmation</div>
          <div class="skill-row">
            <div class="skill-top"><span>JavaScript</span><span class="skill-pct">75%</span></div>
            <div class="skill-track"><div class="skill-fill" data-pct="75"></div></div>
          </div>
          <div class="skill-row">
            <div class="skill-top"><span>PHP</span><span class="skill-pct">70%</span></div>
            <div class="skill-track"><div class="skill-fill" data-pct="70"></div></div>
          </div>
          <div class="skill-row">
            <div class="skill-top"><span>SQL</span><span class="skill-pct">65%</span></div>
            <div class="skill-track"><div class="skill-fill" data-pct="65"></div></div>
          </div>
          <div class="skill-row">
            <div class="skill-top"><span>Python</span><span class="skill-pct">60%</span></div>
            <div class="skill-track"><div class="skill-fill" data-pct="60"></div></div>
          </div>
          <div class="skill-row">
            <div class="skill-top"><span>C / C++</span><span class="skill-pct">50%</span></div>
            <div class="skill-track"><div class="skill-fill" data-pct="50"></div></div>
          </div>
          <div class="skill-row">
            <div class="skill-top"><span>C#</span><span class="skill-pct">45%</span></div>
            <div class="skill-track"><div class="skill-fill" data-pct="45"></div></div>
          </div>
        </div>
        <div class="card">
          <div class="card-head"><div class="card-head-dot"></div>Technologies &amp; Outils</div>
          <div class="tool-section">
            <div class="tool-label"><i class="fa-solid fa-globe" style="font-size:9px"></i> Web</div>
            <span class="tag"><i class="fa-brands fa-html5" style="font-size:10px;color:#e34f26"></i> HTML</span>
            <span class="tag"><i class="fa-brands fa-css3-alt" style="font-size:10px;color:#1572b6"></i> CSS</span>
            <span class="tag"><i class="fa-brands fa-bootstrap" style="font-size:10px;color:#7952b3"></i> Bootstrap</span>
          </div>
          <div class="tool-section">
            <div class="tool-label"><i class="fa-solid fa-pen-ruler" style="font-size:9px"></i> Design</div>
            <span class="tag cyan"><i class="fa-brands fa-adobe" style="font-size:10px"></i> Photoshop</span>
            <span class="tag cyan"><i class="fa-brands fa-adobe" style="font-size:10px"></i> Illustrator</span>
          </div>
          <div class="tool-section">
            <div class="tool-label"><i class="fa-solid fa-screwdriver-wrench" style="font-size:9px"></i> Dev Tools</div>
            <span class="tag amber"><i class="fa-brands fa-git-alt" style="font-size:10px"></i> Git</span>
            <span class="tag amber"><i class="fa-brands fa-github" style="font-size:10px"></i> GitHub</span>
            <span class="tag amber"><i class="fa-solid fa-code" style="font-size:10px"></i> VS Code</span>
            <span class="tag amber"><i class="fa-brands fa-microsoft" style="font-size:10px"></i> MS Office</span>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-head"><div class="card-head-dot"></div>Soft Skills</div>
        <div class="soft-grid">
          <div class="soft-item"><i class="fa-solid fa-brain" style="color:var(--p2)"></i> Pensée analytique</div>
          <div class="soft-item"><i class="fa-solid fa-people-group" style="color:var(--p2)"></i> Travail en équipe</div>
          <div class="soft-item"><i class="fa-solid fa-comments" style="color:var(--p2)"></i> Communication</div>
          <div class="soft-item"><i class="fa-solid fa-lightbulb" style="color:var(--p2)"></i> Initiative</div>
          <div class="soft-item"><i class="fa-solid fa-fire" style="color:var(--p2)"></i> Motivation</div>
          <div class="soft-item"><i class="fa-solid fa-shield-check" style="color:var(--p2)"></i> Fiabilité</div>
        </div>
      </div>
    </div>

    <!-- ══════ TAB: EXPERIENCE ══════ -->
    <div id="tab-experience" class="tab-content">
      <div class="exp-card">
        <div class="exp-header">
          <div>
            <div class="exp-role">Stagiaire IT</div>
            <div class="exp-company">Assurance SanLam</div>
          </div>
          <span class="tag green"><i class="fa-solid fa-check" style="font-size:9px"></i> Avril 2025 · 1 mois</span>
        </div>
        <div class="exp-meta">
          <span><i class="fa-solid fa-location-dot"></i> Errachidia, Maroc</span>
          <span><i class="fa-solid fa-calendar"></i> Stage IT — 1 mois</span>
          <span><i class="fa-solid fa-laptop-code"></i> Développement Web</span>
        </div>
        <hr class="exp-divider"/>
        <div class="task-row">
          <div class="task-icon"><i class="fa-solid fa-globe"></i></div>
          <span>Création de petits sites web</span>
        </div>
        <div class="task-row">
          <div class="task-icon"><i class="fa-solid fa-wrench"></i></div>
          <span>Aide dans des tâches informatiques simples</span>
        </div>
        <div class="task-row">
          <div class="task-icon"><i class="fa-solid fa-code"></i></div>
          <span>Premières expériences en développement logiciel</span>
        </div>
        <div class="task-row">
          <div class="task-icon"><i class="fa-solid fa-terminal"></i></div>
          <span>Participation à de petites tâches de programmation</span>
        </div>
        <div class="task-row">
          <div class="task-icon"><i class="fa-brands fa-html5"></i></div>
          <span>Utilisation des bases de HTML, CSS et JavaScript</span>
        </div>
      </div>
    </div>

    <!-- ══════ TAB: PROJECTS ══════ -->
    <div id="tab-projects" class="tab-content">
      <div class="proj-card" onmousemove="trackMouse(event,this)">
        <div class="proj-top">
          <div>
            <div class="proj-title">Site E-commerce — Vêtements</div>
            <div class="proj-subtitle">Projet personnel fullstack</div>
          </div>
          <div class="proj-icon-wrap">
            <i class="fa-solid fa-cart-shopping"></i>
          </div>
        </div>
        <p class="proj-desc">
          Conception et réalisation d'un site de vente en ligne. Frontend développé avec HTML, CSS et JavaScript. Backend avec PHP et SQL pour la gestion des produits et des utilisateurs.
        </p>
        <div>
          <span class="tag"><i class="fa-brands fa-html5" style="font-size:9px;color:#e34f26"></i> HTML</span>
          <span class="tag"><i class="fa-brands fa-css3-alt" style="font-size:9px;color:#1572b6"></i> CSS</span>
          <span class="tag"><i class="fa-brands fa-js" style="font-size:9px;color:#f7df1e"></i> JavaScript</span>
          <span class="tag"><i class="fa-brands fa-php" style="font-size:9px;color:#8892be"></i> PHP</span>
          <span class="tag"><i class="fa-solid fa-database" style="font-size:9px"></i> SQL</span>
          <span class="tag green" style="margin-top:8px;display:inline-flex">
            <i class="fa-solid fa-circle-check" style="font-size:9px"></i> Terminé
          </span>
        </div>
      </div>
    </div>

    <!-- ══════ TAB: MORE ══════ -->
    <div id="tab-more" class="tab-content">
      <div class="grid-2" style="margin-bottom:16px">
        <div class="card">
          <div class="card-head"><div class="card-head-dot"></div>Loisirs</div>
          <div>
            <span class="hobby-pill"><i class="fa-solid fa-person-swimming" style="color:var(--p2)"></i> Natation</span>
            <span class="hobby-pill"><i class="fa-solid fa-futbol" style="color:var(--p2)"></i> Football</span>
            <span class="hobby-pill"><i class="fa-solid fa-circle-dot" style="color:var(--p2)"></i> Billard</span>
          </div>
        </div>
        <div class="card">
          <div class="card-head"><div class="card-head-dot"></div>Qualifications</div>
          <div class="permis-box">
            <i class="fa-solid fa-car" style="color:var(--p2);font-size:18px"></i>
            Permis de conduire — Catégorie B (valide)
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-head"><div class="card-head-dot"></div>Me contacter</div>
        <div class="contact-grid">
          <div class="contact-mini">
            <div class="contact-mini-label"><i class="fa-solid fa-envelope"></i> Email</div>
            <div class="contact-mini-val">arguiouane.abdelhakim@gmail.com</div>
          </div>
          <div class="contact-mini">
            <div class="contact-mini-label"><i class="fa-solid fa-phone"></i> Téléphone</div>
            <div class="contact-mini-val">+212 693 531 044</div>
          </div>
          <div class="contact-mini">
            <div class="contact-mini-label"><i class="fa-solid fa-location-dot"></i> Localisation</div>
            <div class="contact-mini-val">Errachidia, Maroc</div>
          </div>
          <div class="contact-mini">
            <div class="contact-mini-label"><i class="fa-brands fa-github"></i> GitHub</div>
            <div class="contact-mini-val">github.com/hakimo-0</div>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ══════════════ MOBILE BOTTOM NAV ══════════════ -->
<nav class="mobile-nav">
  <button class="mob-nav-item active" onclick="switchTab('overview',this)" data-mob>
    <i class="fa-solid fa-house"></i>
    Aperçu
  </button>
  <button class="mob-nav-item" onclick="switchTab('skills',this)" data-mob>
    <i class="fa-solid fa-bolt"></i>
    Skills
  </button>
  <button class="mob-nav-item" onclick="switchTab('experience',this)" data-mob>
    <i class="fa-solid fa-briefcase"></i>
    Expérience
  </button>
  <button class="mob-nav-item" onclick="switchTab('projects',this)" data-mob>
    <i class="fa-solid fa-rocket"></i>
    Projets
  </button>
  <button class="mob-nav-item" onclick="switchTab('more',this)" data-mob>
    <i class="fa-solid fa-ellipsis"></i>
    Plus
  </button>
</nav>

<script>
/* ═══════════════════════════════════════
   PARTICLES
═══════════════════════════════════════ */
const canvas = document.getElementById('particles');
const ctx = canvas.getContext('2d');
let W, H, particles = [];

function resize(){
  W = canvas.width = window.innerWidth;
  H = canvas.height = window.innerHeight;
}
resize();
window.addEventListener('resize', resize);

class Particle{
  constructor(){this.reset()}
  reset(){
    this.x = Math.random()*W;
    this.y = Math.random()*H;
    this.r = Math.random()*1.5+.5;
    this.vx = (Math.random()-.5)*.3;
    this.vy = (Math.random()-.5)*.3;
    this.alpha = Math.random()*.6+.1;
    this.color = Math.random()>.5 ? '99,102,241' : '6,182,212';
  }
  update(){
    this.x+=this.vx; this.y+=this.vy;
    if(this.x<0||this.x>W||this.y<0||this.y>H) this.reset();
  }
  draw(){
    ctx.beginPath();
    ctx.arc(this.x,this.y,this.r,0,Math.PI*2);
    ctx.fillStyle=`rgba(${this.color},${this.alpha})`;
    ctx.fill();
  }
}

for(let i=0;i<80;i++) particles.push(new Particle());

function drawConnections(){
  for(let i=0;i<particles.length;i++){
    for(let j=i+1;j<particles.length;j++){
      const dx=particles[i].x-particles[j].x;
      const dy=particles[i].y-particles[j].y;
      const d=Math.sqrt(dx*dx+dy*dy);
      if(d<120){
        ctx.beginPath();
        ctx.moveTo(particles[i].x,particles[i].y);
        ctx.lineTo(particles[j].x,particles[j].y);
        ctx.strokeStyle=`rgba(99,102,241,${.12*(1-d/120)})`;
        ctx.lineWidth=.5;
        ctx.stroke();
      }
    }
  }
}

function animate(){
  ctx.clearRect(0,0,W,H);
  drawConnections();
  particles.forEach(p=>{p.update();p.draw()});
  requestAnimationFrame(animate);
}
animate();

/* ═══════════════════════════════════════
   TAB SWITCHING
═══════════════════════════════════════ */
const tabMeta = {
  overview:   {title:'Aperçu général',            sub:'Bienvenue sur mon dashboard interactif'},
  skills:     {title:'Compétences',               sub:'Langages, technologies et soft skills'},
  experience: {title:'Expérience professionnelle',sub:'Mon parcours professionnel'},
  projects:   {title:'Projets',                   sub:'Ce que j\'ai réalisé'},
  more:       {title:'Plus d\'infos',             sub:'Loisirs, contact et qualifications'},
};

function switchTab(id, el){
  document.querySelectorAll('.tab-content').forEach(t=>{
    t.classList.remove('active');
    t.style.display='none';
  });
  const tab = document.getElementById('tab-'+id);
  tab.style.display='block';
  setTimeout(()=>tab.classList.add('active'),10);

  // sync sidebar nav
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  // sync mobile nav
  document.querySelectorAll('.mob-nav-item').forEach(n=>n.classList.remove('active'));

  // activate clicked + its sibling (sidebar or mobile)
  el.classList.add('active');

  // find index of clicked item and activate the matching one in the other nav
  const allSidebar = [...document.querySelectorAll('.nav-item')];
  const allMobile  = [...document.querySelectorAll('.mob-nav-item')];
  let idx = allSidebar.indexOf(el);
  if(idx === -1) idx = allMobile.indexOf(el);
  if(idx !== -1){
    if(allSidebar[idx]) allSidebar[idx].classList.add('active');
    if(allMobile[idx])  allMobile[idx].classList.add('active');
  }

  document.getElementById('page-title').textContent = tabMeta[id].title;
  document.getElementById('page-sub').textContent   = tabMeta[id].sub;

  // scroll main to top on mobile
  document.querySelector('.main').scrollTo({top:0,behavior:'smooth'});

  if(id==='skills') animateSkills();
}

/* ═══════════════════════════════════════
   SKILL BAR ANIMATION
═══════════════════════════════════════ */
function animateSkills(){
  document.querySelectorAll('.skill-fill').forEach(bar=>{
    bar.style.width='0';
    setTimeout(()=>{
      bar.style.width = bar.dataset.pct + '%';
    }, 100);
  });
}

/* init skills on load if active */
window.addEventListener('load', ()=>{
  animateSkills();
  // animate lang dots staggered
  document.querySelectorAll('.lang-dot.on').forEach((d,i)=>{
    d.style.opacity='0';
    d.style.transform='scale(0)';
    d.style.transition=`all .3s ${i*.06}s`;
    setTimeout(()=>{
      d.style.opacity='1';
      d.style.transform='scale(1)';
    }, 400 + i*60);
  });
  // animate stat values counter
  document.querySelectorAll('.stat-val').forEach(el=>{
    const raw = el.textContent;
    const num = parseInt(raw);
    if(!isNaN(num)){
      let cur=0;
      const target = num;
      const suffix = raw.replace(String(num),'');
      const step = Math.ceil(target/30);
      const t = setInterval(()=>{
        cur = Math.min(cur+step, target);
        el.textContent = cur + suffix;
        if(cur>=target) clearInterval(t);
      }, 40);
    }
  });
});

/* ═══════════════════════════════════════
   MOUSE TRACK ON PROJECT CARD
═══════════════════════════════════════ */
function trackMouse(e, el){
  const r = el.getBoundingClientRect();
  el.style.setProperty('--mx', (e.clientX - r.left) + 'px');
  el.style.setProperty('--my', (e.clientY - r.top)  + 'px');
}

/* ═══════════════════════════════════════
   SCROLL-TRIGGERED CARD ENTRY
═══════════════════════════════════════ */
const observer = new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.style.animationPlayState='running';
    }
  });
},{threshold:.1});

document.querySelectorAll('.card,.stat-card,.exp-card,.proj-card')
  .forEach(c=>{
    c.style.animationPlayState='paused';
    observer.observe(c);
  });
</script>
</body>
</html>
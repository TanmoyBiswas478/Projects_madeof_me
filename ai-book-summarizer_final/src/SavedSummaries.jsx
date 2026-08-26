// ===== 📁 src/SavedSummaries.jsx =====
import { useNavigate } from 'react-router-dom';
import { useEffect, useState } from 'react';
import useSummaryStore from './store/summaryStore';

// Mobile responsive styles
const mobileStyles = `
  @media (max-width: 768px) {
    .app-frame { flex-direction: column; }
    .rail { width: 100%; padding: 15px; border-right: none; border-bottom: 1px solid var(--border); }
    .workspace { padding: 20px; }
    .header { padding: 0 20px; }
    .content { padding: 20px; }
    .search-bar { margin-bottom: 20px; }
    .summary-card { margin-bottom: 20px; }
    .card-meta { font-size: 10px; }
    .summary-text { font-size: 14px; }
    .btn-group-sm .btn { padding: 6px 10px; font-size: 12px; }
  }
  
  @media (max-width: 480px) {
    .app-frame { flex-direction: column; }
    .rail { width: 100%; padding: 10px; border-right: none; border-bottom: 1px solid var(--border); }
    .workspace { padding: 15px; }
    .header { padding: 0 15px; }
    .content { padding: 15px; }
    .search-bar { margin-bottom: 15px; }
    .summary-card { margin-bottom: 15px; }
    .card-meta { font-size: 9px; }
    .summary-text { font-size: 13px; }
    .btn-group-sm .btn { padding: 5px 8px; font-size: 11px; }
  }
`;

// Inject mobile styles
if (typeof window !== 'undefined') {
  const styleElement = document.createElement('style');
  styleElement.textContent = mobileStyles;
  document.head.appendChild(styleElement);
}

export default function SavedSummaries() {
  const navigate = useNavigate();
  const { setText, setSummary } = useSummaryStore();
  const [saved, setSaved] = useState([]);
  const [search, setSearch] = useState('');
  const [theme] = useState(localStorage.getItem("summ-theme") || "dark");

  const storageKey = 'ai-summaries-storage';

  useEffect(() => {
    // Read from the same key used in MainSummarizer
    const data = JSON.parse(localStorage.getItem(storageKey) || '[]');
    setSaved(data);
  }, []);

  const filteredSummaries = saved.filter(item =>
    item.summary.toLowerCase().includes(search.toLowerCase()) ||
    item.title.toLowerCase().includes(search.toLowerCase())
  );

  const reuseSummary = (item) => {
    setText(item.text || "");
    setSummary(item.summary || "");
    navigate("/main"); // Go back to editor
  };

  const deleteSummary = (id) => {
    const updated = saved.filter(item => item.id !== id);
    setSaved(updated);
    localStorage.setItem(storageKey, JSON.stringify(updated));
  };

  const downloadAsText = (item) => {
    const content = `DATE: ${item.date}\nLANG: ${item.lang}\n\nSUMMARY:\n${item.summary}`;
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `summary_${item.id}.txt`;
    link.click();
  };

  const isDark = theme === "dark";

  return (
    <div className={`app-frame ${isDark ? 'theme-dark' : 'theme-light'}`}>
      <style>{`
        :root {
          --accent: #6366f1;
          --bg: ${isDark ? '#0b0f1a' : '#f8fafc'};
          --side: ${isDark ? '#111827' : '#ffffff'};
          --panel: ${isDark ? 'rgba(31, 41, 55, 0.7)' : 'rgba(255, 255, 255, 0.9)'};
          --text: ${isDark ? '#f3f4f6' : '#1e293b'};
          --border: ${isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.05)'};
        }
        body, html { margin:0; padding:0; font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); }
        .app-frame { display: flex; height: 100vh; }
        
        .rail { width: 70px; background: var(--side); border-right: 1px solid var(--border); display: flex; flex-direction: column; align-items: center; padding: 25px 0; gap: 30px; }
        .rail-btn { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #6b7280; font-size: 20px; border: none; background: transparent; transition: 0.3s; }
        .rail-btn.active { background: var(--accent); color: white; box-shadow: 0 4px 12px rgba(99,102,241,0.3); }

        .workspace { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .header { height: 70px; display: flex; align-items: center; justify-content: space-between; padding: 0 40px; border-bottom: 1px solid var(--border); background: var(--side); }
        .content { flex: 1; padding: 30px 60px; overflow-y: auto; background: radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.05), transparent 600px); }

        .search-bar { background: var(--panel); border: 1px solid var(--border); border-radius: 15px; padding: 12px 20px; color: var(--text); width: 100%; max-width: 500px; outline: none; margin-bottom: 30px; backdrop-filter: blur(10px); }
        
        .summary-card { background: var(--panel); border: 1px solid var(--border); border-radius: 20px; padding: 25px; margin-bottom: 20px; backdrop-filter: blur(10px); transition: 0.3s; }
        .summary-card:hover { transform: translateY(-3px); border-color: var(--accent); }
        
        .card-meta { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #6b7280; margin-bottom: 10px; display: flex; gap: 15px; }
        .summary-text { line-height: 1.6; font-size: 15px; opacity: 0.9; margin: 15px 0; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        
        .btn-group-sm .btn { border-radius: 8px; font-size: 12px; font-weight: 700; margin-right: 8px; padding: 6px 15px; }
        .btn-load { background: var(--accent); color: white; border: none; }
        .btn-del { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
        .btn-dl { background: rgba(255,255,255,0.05); color: var(--text); border: 1px solid var(--border); }
      `}</style>

      {/* LEFT RAIL */}
      <aside className="rail">
        <div style={{fontSize: 24, marginBottom: 20}}>🚀</div>
        <button className="rail-btn" onClick={() => navigate("/main")}>🏠</button>
        <button className="rail-btn active">📚</button>
      </aside>

      {/* MAIN WORKSPACE */}
      <main className="workspace">
        <header className="header">
          <h2 className="m-0" style={{fontSize: 18, fontWeight: 800}}>Saved<span style={{color: 'var(--accent)'}}>.Library</span></h2>
          <div className="small text-muted font-weight-bold">{saved.length} ITEMS SAVED</div>
        </header>

        <div className="content">
          <input
            type="text"
            className="search-bar shadow-sm"
            placeholder="🔍 Search through your knowledge base..."
            value={search}
            onChange={(e) => setSearch(e.target.value)}
          />

          {filteredSummaries.length === 0 ? (
            <div className="text-center py-5 opacity-50">
               <h3>No summaries found</h3>
               <p>Summaries you save from the editor will appear here.</p>
            </div>
          ) : (
            filteredSummaries.map((item) => (
              <div key={item.id} className="summary-card shadow-sm">
                <div className="card-meta">
                  <span>📅 {item.date}</span>
                  <span style={{color: 'var(--accent)'}}>🌐 {item.lang || 'English'}</span>
                  {item.accuracy && <span style={{color: '#10b981'}}>🎯 {item.accuracy}% Accuracy</span>}
                </div>
                <h5 className="font-weight-bold m-0" style={{fontSize: 17}}>{item.title}</h5>
                <p className="summary-text">{item.summary}</p>
                
                <div className="btn-group-sm d-flex">
                  <button className="btn btn-load" onClick={() => reuseSummary(item)}>🔁 Load in Editor</button>
                  <button className="btn btn-dl" onClick={() => downloadAsText(item)}>⬇ Download</button>
                  <button className="btn btn-del ml-auto" onClick={() => deleteSummary(item.id)}>🗑 Delete</button>
                </div>
              </div>
            ))
          )}
        </div>
      </main>
    </div>
  );
}
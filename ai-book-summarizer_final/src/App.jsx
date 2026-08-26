// ===== 📁 src/App.jsx =====
import { Routes, Route, Navigate, useNavigate } from "react-router-dom";
import Login from "./pages/Login";
import UserDashboard from "./pages/UserDashboard";
import MainSummarizer from "./MainSummarizer";
import SavedSummaries from "./SavedSummaries";
import Images from "./images";
import Initiative from "./initiative";
import Pricing from "./pricing";

export default function App() {
  const navigate = useNavigate();

  return (
    <div>
      <Routes>
        <Route path="/"        element={<Navigate to="/login" replace />} />
        <Route path="/login"   element={<Login />} />
        <Route path="/dashboard" element={<UserDashboard />} />
        <Route path="/main"    element={<MainSummarizer />} />
        <Route path="/saved"   element={<SavedSummaries />} />
        <Route path="/images"  element={<Images />} />
        <Route path="/Initiative"  element={<Initiative />} />
        <Route path="/pricing" element={<Pricing />} />
        <Route path="*"        element={<Navigate to="/login" replace />} />
      </Routes>
    </div>
  );
}
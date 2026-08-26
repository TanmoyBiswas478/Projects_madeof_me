// 📁 src/store/summaryStore.js
import { create } from 'zustand';

const useSummaryStore = create((set) => ({
  text: '',
  summary: '',
  setText: (text) => set({ text }),
  setSummary: (summary) => set({ summary }),
}));

export default useSummaryStore;
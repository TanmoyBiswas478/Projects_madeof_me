// Secure Storage Utilities for User Data

class SecureStorage {
  constructor() {
    this.encryptionKey = this.generateEncryptionKey();
  }

  // Generate a simple encryption key based on user info
  generateEncryptionKey() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    const baseKey = `${user.email || 'default'}_${user.name || 'user'}`;
    return this.simpleHash(baseKey);
  }

  // Simple hash function for key generation
  simpleHash(str) {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
      const char = str.charCodeAt(i);
      hash = ((hash << 5) - hash) + char;
      hash = hash & hash; // Convert to 32-bit integer
    }
    return Math.abs(hash).toString(16);
  }

  // Simple XOR encryption
  encrypt(data) {
    const key = this.encryptionKey;
    const dataStr = JSON.stringify(data);
    let encrypted = '';
    
    for (let i = 0; i < dataStr.length; i++) {
      const dataChar = dataStr.charCodeAt(i);
      const keyChar = key.charCodeAt(i % key.length);
      encrypted += String.fromCharCode(dataChar ^ keyChar);
    }
    
    return btoa(encrypted); // Base64 encode
  }

  // Simple XOR decryption
  decrypt(encryptedData) {
    try {
      const key = this.encryptionKey;
      const encrypted = atob(encryptedData); // Base64 decode
      let decrypted = '';
      
      for (let i = 0; i < encrypted.length; i++) {
        const encryptedChar = encrypted.charCodeAt(i);
        const keyChar = key.charCodeAt(i % key.length);
        decrypted += String.fromCharCode(encryptedChar ^ keyChar);
      }
      
      return JSON.parse(decrypted);
    } catch (error) {
      console.error('Decryption failed:', error);
      return null;
    }
  }

  // Save user data securely
  saveUserData(data) {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return false;

    const userKey = `user_data_${user.email}`;
    const encryptedData = this.encrypt(data);
    localStorage.setItem(userKey, encryptedData);
    return true;
  }

  // Load user data securely
  loadUserData() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return null;

    const userKey = `user_data_${user.email}`;
    const encryptedData = localStorage.getItem(userKey);
    
    if (!encryptedData) return null;
    
    return this.decrypt(encryptedData);
  }

  // Save summary for user
  saveSummary(summary) {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return false;

    const summariesKey = `summaries_${user.email}`;
    const existingSummaries = this.loadSummaries();
    
    const newSummary = {
      ...summary,
      id: Date.now().toString(),
      createdAt: new Date().toISOString(),
      userEmail: user.email
    };

    existingSummaries.push(newSummary);
    
    try {
      const encryptedData = this.encrypt(existingSummaries);
      localStorage.setItem(summariesKey, encryptedData);
      return true;
    } catch (error) {
      console.error('Failed to save summary:', error);
      return false;
    }
  }

  // Load all summaries for user
  loadSummaries() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return [];

    const summariesKey = `summaries_${user.email}`;
    const encryptedData = localStorage.getItem(summariesKey);
    
    if (!encryptedData) return [];
    
    const summaries = this.decrypt(encryptedData);
    return summaries || [];
  }

  // Delete specific summary
  deleteSummary(summaryId) {
    const summaries = this.loadSummaries();
    const filteredSummaries = summaries.filter(s => s.id !== summaryId);
    
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    const summariesKey = `summaries_${user.email}`;
    
    try {
      const encryptedData = this.encrypt(filteredSummaries);
      localStorage.setItem(summariesKey, encryptedData);
      return true;
    } catch (error) {
      console.error('Failed to delete summary:', error);
      return false;
    }
  }

  // Update summary
  updateSummary(summaryId, updatedData) {
    const summaries = this.loadSummaries();
    const summaryIndex = summaries.findIndex(s => s.id === summaryId);
    
    if (summaryIndex === -1) return false;
    
    summaries[summaryIndex] = {
      ...summaries[summaryIndex],
      ...updatedData,
      updatedAt: new Date().toISOString()
    };
    
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    const summariesKey = `summaries_${user.email}`;
    
    try {
      const encryptedData = this.encrypt(summaries);
      localStorage.setItem(summariesKey, encryptedData);
      return true;
    } catch (error) {
      console.error('Failed to update summary:', error);
      return false;
    }
  }

  // Export user data
  exportUserData() {
    const userData = this.loadUserData();
    const summaries = this.loadSummaries();
    
    return {
      user: userData,
      summaries: summaries,
      exportDate: new Date().toISOString()
    };
  }

  // Import user data
  importUserData(importedData) {
    try {
      const user = JSON.parse(localStorage.getItem('user') || '{}');
      if (!user.email) return false;

      // Validate imported data
      if (!importedData.summaries || !Array.isArray(importedData.summaries)) {
        throw new Error('Invalid import data');
      }

      // Filter summaries to only include those for current user
      const userSummaries = importedData.summaries.filter(s => s.userEmail === user.email);
      
      // Save imported summaries
      const summariesKey = `summaries_${user.email}`;
      const encryptedData = this.encrypt(userSummaries);
      localStorage.setItem(summariesKey, encryptedData);
      
      return true;
    } catch (error) {
      console.error('Failed to import data:', error);
      return false;
    }
  }

  // Clear all user data
  clearUserData() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return false;

    const keysToRemove = [
      `user_data_${user.email}`,
      `summaries_${user.email}`
    ];

    keysToRemove.forEach(key => {
      localStorage.removeItem(key);
    });

    return true;
  }

  // Get storage statistics
  getStorageStats() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return null;

    const summaries = this.loadSummaries();
    const userData = this.loadUserData();
    
    return {
      totalSummaries: summaries.length,
      totalCharacters: summaries.reduce((acc, s) => acc + (s.originalText?.length || 0), 0),
      storageSize: this.getStorageSize(),
      lastActivity: Math.max(
        ...summaries.map(s => new Date(s.createdAt || s.date).getTime()),
        0
      )
    };
  }

  // Calculate storage size
  getStorageSize() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    if (!user.email) return 0;

    const keys = [
      `user_data_${user.email}`,
      `summaries_${user.email}`
    ];

    let totalSize = 0;
    keys.forEach(key => {
      const data = localStorage.getItem(key);
      if (data) {
        totalSize += data.length;
      }
    });

    return totalSize;
  }
}

export default SecureStorage;

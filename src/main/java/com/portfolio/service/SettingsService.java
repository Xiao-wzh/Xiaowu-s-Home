package com.portfolio.service;

import com.portfolio.entity.Settings;

public interface SettingsService {
    
    Settings getSettingsById(Long id);
    
    boolean updateSettings(Settings settings);
    
    boolean saveSettings(Settings settings);
} 
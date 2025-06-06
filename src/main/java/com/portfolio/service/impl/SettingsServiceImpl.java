package com.portfolio.service.impl;

import com.portfolio.entity.Settings;
import com.portfolio.mapper.SettingsMapper;
import com.portfolio.service.SettingsService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class SettingsServiceImpl implements SettingsService {

    @Autowired
    private SettingsMapper settingsMapper;
    
    @Override
    public Settings getSettingsById(Long id) {
        return settingsMapper.selectById(id);
    }
    
    @Override
    public boolean updateSettings(Settings settings) {
        return settingsMapper.updateById(settings) > 0;
    }
    
    @Override
    public boolean saveSettings(Settings settings) {
        return settingsMapper.insert(settings) > 0;
    }
} 
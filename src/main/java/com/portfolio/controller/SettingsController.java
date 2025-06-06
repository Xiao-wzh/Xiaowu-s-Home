package com.portfolio.controller;

import com.portfolio.entity.Settings;
import com.portfolio.service.SettingsService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/settings")
public class SettingsController {

    @Autowired
    private SettingsService settingsService;
    
    @GetMapping("/{id}")
    public ResponseEntity<Settings> getSettingsById(@PathVariable Long id) {
        Settings settings = settingsService.getSettingsById(id);
        if (settings != null) {
            return ResponseEntity.ok(settings);
        }
        return ResponseEntity.notFound().build();
    }
    
    @PostMapping
    public ResponseEntity<Boolean> createSettings(@RequestBody Settings settings) {
        return ResponseEntity.ok(settingsService.saveSettings(settings));
    }
    
    @PutMapping("/{id}")
    public ResponseEntity<Boolean> updateSettings(@PathVariable Long id, @RequestBody Settings settings) {
        settings.setId(id);
        return ResponseEntity.ok(settingsService.updateSettings(settings));
    }
} 
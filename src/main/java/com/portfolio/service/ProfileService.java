package com.portfolio.service;

import com.portfolio.entity.Profile;

public interface ProfileService {
    
    Profile getProfile(Long id);
    
    void updateProfile(Profile profile);
} 
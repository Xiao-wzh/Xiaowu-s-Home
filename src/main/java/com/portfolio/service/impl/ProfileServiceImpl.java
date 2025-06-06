package com.portfolio.service.impl;

import com.portfolio.entity.Profile;
import com.portfolio.mapper.ProfileMapper;
import com.portfolio.service.ProfileService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class ProfileServiceImpl implements ProfileService {

    @Autowired
    private ProfileMapper profileMapper;
    
    @Override
    public Profile getProfile(Long id) {
        return profileMapper.selectById(id);
    }
    
    @Override
    public void updateProfile(Profile profile) {
        profileMapper.updateById(profile);
    }
} 
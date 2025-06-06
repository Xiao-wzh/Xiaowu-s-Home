package com.portfolio.service.impl;

import com.portfolio.entity.Project;
import com.portfolio.mapper.ProjectMapper;
import com.portfolio.service.ProjectService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;

@Service
public class ProjectServiceImpl implements ProjectService {

    @Autowired
    private ProjectMapper projectMapper;
    
    @Override
    public Project getProjectById(Long id) {
        return projectMapper.selectById(id);
    }
    
    @Override
    public List<Project> getAllProjects() {
        return projectMapper.selectList(null);
    }
    
    @Override
    public boolean saveProject(Project project) {
        return projectMapper.insert(project) > 0;
    }
    
    @Override
    public boolean updateProject(Project project) {
        return projectMapper.updateById(project) > 0;
    }
    
    @Override
    public boolean deleteProject(Long id) {
        return projectMapper.deleteById(id) > 0;
    }
} 
package com.portfolio.service;

import com.portfolio.entity.Project;
import java.util.List;

public interface ProjectService {
    
    Project getProjectById(Long id);
    
    List<Project> getAllProjects();
    
    boolean saveProject(Project project);
    
    boolean updateProject(Project project);
    
    boolean deleteProject(Long id);
} 
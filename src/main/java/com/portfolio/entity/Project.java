package com.portfolio.entity;

import com.baomidou.mybatisplus.annotation.IdType;
import com.baomidou.mybatisplus.annotation.TableId;
import com.baomidou.mybatisplus.annotation.TableName;
import lombok.Data;

@Data
@TableName("project")
public class Project {
    @TableId(type = IdType.AUTO)
    private Long id;
    private String title;
    private String description;
    private String technologies;
    private String thumbnailUrl;
    private String demoUrl;
    private String codeUrl;
} 
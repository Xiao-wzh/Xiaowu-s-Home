package com.portfolio.entity;

import com.baomidou.mybatisplus.annotation.IdType;
import com.baomidou.mybatisplus.annotation.TableId;
import com.baomidou.mybatisplus.annotation.TableName;
import lombok.Data;

@Data
@TableName("settings")
public class Settings {
    @TableId(type = IdType.AUTO)
    private Long id;
    private String theme;
    private String language;
    private Boolean darkMode;
    private String fontFamily;
    private Integer fontSize;
} 